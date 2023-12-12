<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Info_productController;
use App\Models\Info_product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Route::get('URL', [〇〇Controller::class, 'メソッド名']);


//商品一覧画面

//表示
Route::get('/product', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');
//検索
Route::get('/search', [App\Http\Controllers\ProductController::class, 'product'])->name('search');
//新規登録
Route::get('/new_product', [App\Http\Controllers\ProductController::class, 'new_product'])->name('new_product');
//ページネーション
Route::get('/page', [App\Http\Controllers\ProductController::class, 'page_nation'])->name('page_nation');
//詳細
Route::get('/info_product/{id?}',[App\Http\Controllers\ProductController::class,'show'])->name('show');
//削除
Route::post('/destroy{id}', [ProductController::class, 'destroy'])->name('product.destroy');



//商品新規登録画面
//登録
Route::post('/registSubmit',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('registSubmit');




//商品情報詳細画面
Route::get('/edit_product/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');

//表示
Route::get('/info_product', [App\Http\Controllers\ProductController::class, 'showList'])->name('showList');

//商品編集画面
Route::get('/edit_product', [App\Http\Controllers\info_productController::class, 'showEdit_product'])->name('showEdit_product');

Route::get('/return_info', [App\Http\Controllers\info_productController::class, 'return_info'])->name('return_info');


//更新
Route::put('/edit_product/{id}', [App\Http\Controllers\ProductController::class, 'update_product'])->name('update_product');




