<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    public function getList() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }

    public function registProduct($data) {
        // 登録処理



        DB::table('products')->insert([

            'product_name' => $data->product_name,
            'maker' => $data->maker,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'image_path' => $data->product_image,

        ]);
    }

        //リレーション
        public function company()
        {
           
        }
}


