    @extends('layouts.user') @section('title', '商品詳細画面') @section('content')

    <div class="outside">
    <h1>商品情報詳細画面</h1>

    @foreach($products as $product)
    @if($loop->first)
    <p>ID</p>
    <td>{{$products->id}}</td>
    <p>商品画像</p>
    <td><img src="{{$products->image_path}}" /></td>
    <p>商品名</p>
    <td>{{$products->product_name}}</td>
    

    <p>メーカー名</p>
    <td> {{$products->company->company_name}} </td>

    
    <p>価格</p>
    <td>{{$products->price}}</td>
    <p>在庫数</p>
    <td>{{$products->stock}}</td>
    <p>コメント</p>
    <td>{{$products->comment}}</td>
   
    <button class="regist" onclick="location.href='{{ route('edit', ['id' => $products->id]) }}' ">編集</button>

    <button class="info" onclick="location.href='{{ route('list') }}' ">戻る</button>
    @endif @endforeach
    @endsection
    </div>