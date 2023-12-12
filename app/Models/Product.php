<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Models\Company;


class Product extends Model
{
    public function getList() {
        // productsテーブルからデータを取得

        $products = self::with('company')->get();

        return $products;


    }

    public function registProduct($data,$image_path,$product_id) {
        // 登録処理
        DB::table('products')->insert([

            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'image_path' => $data->$image_path,
            'product_id' => $data->$product_id
        ]);


    }

        //リレーション
        public function company()
        {
            return $this->belongsTo(Company::class);
        }



            protected $fillable = ['product_name'];


}


