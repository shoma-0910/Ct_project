
@extends('layouts.user')

@section('title', '商品情報編集画面')

@section('content')

<div class="outside">
<body>

<form action="{{ route('update_product', ['id' => $products->id]) }}" method="post" enctype="multipart/form-data" >
@method('PUT')
      @csrf
<p>商品情報編集画面</p>

<p>ID<a class="red">*</a></p>

<p>商品名<a class="red">*</a></p> <input type="text" id="product_name" name="product_name">

<p>メーカー名<a class="red">*</a></p> <input type="text" id="maker" name="maker">

<p>価格<a class="red">*</a></p> <input type="text" id="price" name="price">

<p>在庫数<a class="red">*</a></p> <input type="text" id="stock" name="stock">

<p>コメント </p> <input type="text" id="comment" name="comment">

<p>商品画像</p>  <input type="file" id="image_path" name="product_image" value="{{ old('image_path') }}">


<button type="submit" class="regist">更新</button>
              <button type="button" class="info" onClick="history.back()">戻る</button>
</form>

<td>

</body>
</div>
</html>

@endsection


