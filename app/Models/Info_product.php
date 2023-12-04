<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Info_product extends Model
{
    public function getList() {
        // info_productsテーブルからデータを取得
        $products = DB::table('products')->get();

        return $products;
    }
}


