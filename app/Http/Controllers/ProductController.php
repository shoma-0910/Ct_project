<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use Illuminate\Pagination\Paginator;


class ProductController extends Controller
{
    // 表示
    public function showList(){
        // インスタンス生成
        $model = new Product();
        $products = $model->getList();
        $model = new Company();
        $companies = $model->getList_companies();
        $pages = Product::orderBy('created_at')->paginate(2);
        $image_path = Product::all();

        return view('product', ['pages' => $pages, 'products' => $products, 'companies' => $companies, 'image_path' =>$image_path]

     );
     }



    // 検索
    public function search(Request $request){
        $pages = Product::paginate(3);
            if(isset($request->keyword)) {
                $products = Product::
                    where('product_name',  'LIKE',"%{$request->keyword}%")

                    ->get();
                }
                elseif(isset($request->companies_table)) {
                    $products = Product::
                        where('company_id',  'LIKE',"%{$request->companies_table}%")

                        ->get();
                    }
                else{
                    $products = Product::get();
                }

            return view('product', [
                'pages' => $pages,
                'products' => $products,
                'keyword' => $request->keyword
            ]);
    }


    //product から info_product へ 詳細
    public function info_product() {
        $model = new Company();
        $companies = $model->getList_companies();
        return view('info_product/{id}',['companies' => $companies]);
    }



    //削除
    public function destroy($id){
        try {
            // トランザクション開始
            DB::beginTransaction();
            // 削除する
            $product = Product::findOrFail($id);
            // レコードを強制的に削除
            $product->delete($id);
            // 処理に成功したらコミット
            DB::commit();
        } catch (\Throwable $e) {
            // 処理に失敗したらロールバック
            DB::rollback();
        }

        return back();

    }


    // product から regist_product へ 登録
    public function new_product() {
        $model = new Product();
        $products = $model->getList();
        $model = new Company();
        $companies = $model->getList_companies();

        return view('regist_product',['products' => $products, 'companies' => $companies]);
    }


    //詳細
    // 表示
    public function show(Request $request) {
        $id = $request->id;
        $products = Product::find($id);
        $model = new Company();
        $companies = $model->getList_companies();
        $company_name = $request->company_name;
        $companies = Company::find($company_name);

        return view('info_product',['products' => $products,'companies' => $companies]);
    }



    // 新規登録
    public function registSubmit(ProductRequest $request) {
        // ディレクトリ名
        $dir = 'images';
        // アップロードされたファイル名を取得
        $file_name = $request->file('image_path')->getClientOriginalName();
        // トランザクション開始
        DB::beginTransaction();
        try {
        // 登録処理呼び出し
        $model = new Product();
            // 取得したファイル名で保存
        $request->file('image_path')->storeAs('public/' . $dir, $file_name);
        $image_path = 'storage/' . $dir . '/' . $file_name;
        $model->registProduct($request,$image_path);
        DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
    }

    // 処理が完了したらregist_productにリダイレクト
    return redirect(route('new_product'));
    }


    // regist_productから productへ
    public function back_product() {
        return view('product');
    }


    //商品情報編集画面
    public function showEdit_product() {

        $model = new Product();
        $products = $model->getList();
        $model = new Company();
        $companies = $model->getList_companies();
        $image_path = Product::all();
        $company =Company::all();
        $products = $model->getList();

    return view('edit_product', ['company' => $company,'companies' => $companies, 'products' => $products, 'image_path' =>$image_path]);
    }


    public function edit(Request $request) {
        $id = $request->id;
        $products = Product::find($id);
        $model = new Company();
        $companies = $model->getList_companies();
        return view('edit_product',['products' => $products,'companies' => $companies]);
    }



     //更新
     public function update_product(ProductRequest $request, $id)
     {
        // ディレクトリ名
        $dir = 'images';
        // アップロードされたファイル名を取得
        $image= $request->file('image_path');
              // トランザクション開始
        DB::beginTransaction();
        try {
            $products = Product::find($id);
            if($image){
               $file_name = $image->getClientOriginalName();
                  // 取得したファイル名で保存
                $request->file('image_path')->storeAs('public/' . $dir, $file_name);
                $image_path = 'storage/' . $dir . '/' . $file_name;
                $products->update([
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    "comment" => $request->comment,
                    'image_path' => $image_path,
                    'company_id' => $request->companies_table
                ]);
            }else{
                $products->update([
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    "comment" => $request->comment,
                    'companies_table' => $request->companies_table
                ]);
            }
        DB::commit();
        } catch (\Exception $e) {
        DB::rollback();
        return back();
        }

         return redirect()->route('update_product', ['id' => $products->id]);

     }

 }