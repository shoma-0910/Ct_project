<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required | max:255',
            'price' => 'required | max:255',
            'stock' => 'required | max:255',
            'companies_table' => 'required | max:255',
            'comment' => 'required | max:255',
            'image_path' => 'required',

        ];
    }

   public function attributes()
   {
       return [
        'product_name' => '商品名',
        'price' => '価格',
        'stock' => '在庫数',
        'companies_table' => 'メーカー名',
        'comment' => 'コメント',
        'image_path' => 'コメント',
       ];
   }

   /**
    * エラーメッセージ
    *
    * @return array
    */
   public function messages() {
       return [
           'product_name' => ':attributeは必須項目です。',
           'price' => ':attributeは必須項目です。',
           'stock' => ':attributeは必須項目です。',
           'companies_table' => ':attributeは必須項目です。',
           'comment' => ':attributeは必須項目です。',
           'image_path' => ':attributeは必須項目です。'
       ];
   }
}




