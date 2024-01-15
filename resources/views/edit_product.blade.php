
@extends('layouts.user')

@section('title', '商品情報編集画面')

@section('content')




<h1>商品情報編集画面</h1>
<div class="outside">
<form action="{{ route('update_product', ['id' => $products->id]) }}" method="POST" enctype="multipart/form-data"  >

@csrf
@method('PATCH')
    <tr>
        <td>ID</td>
        @foreach($products as $product)
            @if($loop->first)
                <td>{{$products->id}}</td>
        @endif @endforeach
    </tr>


    <p>商品名<a class="red">*</a></p>
        <input type="text" id="product_name" name="product_name" value="{{$products->product_name}}">


    <p>メーカー名<a class="red">*</a></p>
        <select name="company_name  value="{{$products->company_name}}">

            @foreach($companies as $company)
            <option value="{{$company->id}}" >
                {{$company->company_name}}
            </option>
            @endforeach
        </select>





    <p>価格<a class="red">*</a></p>
    <input type="text" id="price" name="price"  value="{{$products->price}}" />
    @if($errors->has('price'))
    <p>{{ $errors->first('price') }}</p>
    @endif

    <p>在庫数<a class="red">*</a></p>
    <input type="text" id="stock" name="stock" value="{{$products->stock}}" />
    @if($errors->has('stock'))
    <p>{{ $errors->first('stock') }}</p>
    @endif

    <p>コメント</p>
    <input type="text" id="comment" name="comment" value="{{$products->comment}}" />

    <p>商品画像</p>
    <input type="file" id="image_path" name="image_path" value="{{$products->image_path}}}}" />


            <button type="submit" class="regist">更新</button>
            <button type="button" class="info" onClick="history.back()">戻る</button>

</div>
@endsection
</form>



