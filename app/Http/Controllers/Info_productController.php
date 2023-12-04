<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info_product;
use Illuminate\Support\Facades\DB;
use App\Product;
class Info_productController extends Controller

{
    public function showList() {
        // インスタンス生成
        $model = new Info_product();
        $info_products = $model->getList();

        return view('info_product', ['info_products' => $info_products]);
    }

    public function showInfo_ProductForm() {
        return view('info_product');
        //return Product::all();
    }



   //詳細
   public function edit_detail(Request $request) {
    $id = $request->id;
    $products = Info_product::find($id);
    return view('info_product',['products' => $products,]);
}



//商品情報編集画面
    public function showEdit_product() {
        $info_products = info_product::findOrFail($request->id);
        $model = new Info_Product();
        $info_products = $model->getList();

        return view('edit_product', ['info_products' => $info_products]);
    }
    public function showEdit_productForm() {
        return view('edit_product');
        //return Product::all();
    }


    public function return_info(Request $request) {
        $id = $request->id;
        $products = Info_product::find($id);
        return view('info_product',['products' => $products,]);
    }


        //更新
        public function update_product(Request $request)
        {
            $product = info_product::findOrFail($request->id);
            $product->update([
              "product_name" => $request->product_name,
              "maker" => $request->maker,
              "price" => $request->price,
              "stock" => $request->stock,
              "comment" => $request->comment,
              "image_path" => $request->image_path,
            ]);
            // return redirect()->route('edit_product', ['id' => $product->id]);
            return back();
        }
}



