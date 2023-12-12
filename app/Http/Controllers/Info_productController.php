<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info_product;
use Illuminate\Support\Facades\DB;

use App\Models\Models\Company;
use App\Models\Product;

class Info_productController extends Controller

{
   

    public function showList() {
        // インスタンス生成
        $model = new Info_product();
        $info_products = $model->getList();
        $model = new Company();
        $companies = $model->getList_companies();

        return view('info_product', ['info_products' => $info_products, 'companies' => $companies]);
    }

//商品情報編集画面
    public function showEdit_product() {

            $model = new Product();
            $products = $model->getList();
            $model = new Company();
            $companies = $model->getList_companies();
            $image_path = Product::all();


 
        $products = $model->getList();
        return view('edit_product', ['companies' => $companies, 'products' => $products, 'image_path' =>$image_path]);
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

              "price" => $request->price,
              "stock" => $request->stock,
              "comment" => $request->comment,
              "image_path" => $request->image_path,
            ]);
            // return redirect()->route('edit_product', ['id' => $product->id]);
            return back();
        }
}



