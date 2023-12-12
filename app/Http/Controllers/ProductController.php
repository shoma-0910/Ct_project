<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\Models\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductController extends Controller
{
    // 表示
    public function showList() {
        // インスタンス生成
        $model = new Product();
        $products = $model->getList();
        $model = new Company();
        $companies = $model->getList_companies();
        $pages = Product::paginate(5);
        $image_path = Product::all();

        return view('product', ['pages' => $pages, 'products' => $products, 'companies' => $companies, 'image_path' =>$image_path]

    );
    }



// 検索
public function product(Request $request)
{    $pages = Product::paginate(5);
    if (isset($request->keyword)) {
        $products = Product::
            where('product_name',  'LIKE',"%{$request->keyword}%")

            ->get();
        }
    else {
        $products = Product::get();
    }

    return view('product', [
        'pages' => $pages,
        'products' => $products,
        'keyword' => $request->keyword
    ]);
}



  // product から info_product へ 詳細
    public function info_product() {
        $model = new Company();
        $companies = $model->getList_companies();
        return view('info_product/{id}',['companies' => $companies]);
    }


     // 削除
     public function destroy($id)
     {
         // Productテーブルから指定のIDのレコード1件を取得
         $product = Product::find($id);
         // レコードを削除
         $product->delete();
         // 削除したら一覧画面にリダイレクト
         return redirect()->route('list');
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




    $company_name = $request->company_name;
    $model->registProduct($request,$company_name,$image_path);
    DB::commit();




} catch (\Exception $e) {
    DB::rollback();
    return back();
}







    // 処理が完了したらregist_productにリダイレクト
    return redirect(route('showRegist'));

}

    // regist_productから productへ
    public function back_product() {
        return view('product');
    }





    public function edit(Request $request) {
        $id = $request->id;
        $products = Product::find($id);

        $model = new Company();
        $companies = $model->getList_companies();

        return view('edit_product',['products' => $products,'companies' => $companies]);
    }





        //更新
        public function update_product(Request $request)
        {

            
            $products = Product::findOrFail($request->id);
            $products->update([
              "product_name" => $request->product_name,
              "price" => $request->price,
              "stock" => $request->stock,
              "comment" => $request->comment,
              "image_path" => $request->image_path,
            ]);

          return redirect()->route('edit_product', ['id' => $products->id]);

        }

}




