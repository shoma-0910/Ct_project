<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
