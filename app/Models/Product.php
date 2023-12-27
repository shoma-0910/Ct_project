<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Company;
use App\Models\Sale;

class Product extends Model
{

    protected $fillable = ['product_name','price','stock','comment','image_path','company_id'];

    public function getList() {
        // productsテーブルからデータを取得

        $products = self::with('company')->get();

        return $products;


    }

    public function registProduct($data,$image_path) {
        // 登録処理

        DB::table('products')->insert([

            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'image_path' => $image_path,
            'company_id' => $data->companies_table
        ]);


    }

    //リレーション
    public function company() {

        return $this->belongsTo(Company::class);

    }


    //saleリレーション
    public function sale(){

        return $this->hasMany(Sale::class);

    }



    // 更新処理
    public function update_product($data, $products, $image_path){

        $products= $products->fill([
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'image_path' => $image_path,
            'company_id' => $data->companies_table
        ])->save();

    }


}

