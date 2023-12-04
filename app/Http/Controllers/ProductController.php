<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductController extends Controller
{
    public function showList() {
        // インスタンス生成
        $model = new Product();
        $products = $model->getList();
        $pages = Product::paginate(5);
        //$images = Product::all();
        return view('product',  ['pages' => $pages],['products' => $products],
       // ['images' => $images]
    );
    }

    public function product(Request $request)
    {
        /* テーブルから全てのレコードを取得する */
       $query = product::query();
        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keywordが空ではない場合、検索処理を実行します
            $query->where('product_name', 'LIKE', "%{$keyword}%");
    }
    }

    /* ページネーション */
    public function page()
    {
     
       return view('list', compact('page_nations'));
    }


    // product から regist_product へ
    public function new_product() {
        return view('regist_product');
    }
  // product から info_product へ
    public function info_product() {
        return view('info_product/{id}');
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



    //詳細
    public function show(Request $request) {
        $id = $request->id;
        $products = Product::find($id);
        return view('info_product',['products' => $products]);
    }

//商品新規登録画面
    public function showRegistForm() {
        return view('regist_product');
    }

   public function registSubmit(ProductRequest $request) {
    // トランザクション開始
    DB::beginTransaction();
    try {
        // 登録処理呼び出し
        $model = new Product();
        $model->registProduct($request);
        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back();
    }

     // ディレクトリ名
     $dir = 'images';

     // アップロードされたファイル名を取得
     $file_name = $request->file('image_path')->getClientOriginalName();

     // 取得したファイル名で保存
     $request->file('image_path')->storeAs('public/' . $dir, $file_name);

     
     
    // 処理が完了したらregist_productにリダイレクト
    return redirect(route('showRegist'));
    }

    // regist_productから productへ
    public function back_product() {
        return view('product');
    }



  //リレーション
    public function index()
    {
        return $this->belongsTo(Company::class);
        }





    public function upload(Request $request)
    {
        // ディレクトリ名
        $dir = 'images';

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

            // ファイル情報をDBに保存
            $image = new Image();
            $image->name = $file_name;
            $image->path = 'storage/' . $dir . '/' . $file_name;
            $image->save();

        return redirect('/');
    }



    public function edit(Request $request) {
        $id = $request->id;
        $products = Product::find($id);
        return view('edit_product',['products' => $products,]);
    }


        //更新
        public function update_product(Request $request)
        {
            $product = Product::findOrFail($request->id);
            $product->update([
              "product_name" => $request->product_name,
              "maker" => $request->maker,
              "price" => $request->price,
              "stock" => $request->stock,
              "comment" => $request->comment,
              "image_path" => $request->image_path,
            ]);

            return redirect("return_info'");

        }
}




