@extends('layouts.user') @section('title', '商品一覧画面') @section('content')
<h1>商品一覧画面</h1>

<div class="outside">
<form action="{{ route('search') }}" method="GET">
    @csrf

    <input type="text" name="keyword" placeholder="検索キーワード" />

    <select name="company_name" placeholder="メーカー名">
            <option>メーカー名</option>
            @foreach($products as $product)
            <option value="{{ $product->company->company_name }}" >
                {{$product->company->company_name}}
            </option>
            @endforeach
        </select>

        <input type="submit" class="button" value="検索" />

        </form>

        <table class="table" style="width: 1000px; max-width: 0 auto;">
            <tr class="table-info">
                <th scope="col">id</th>
                <th scope="col">商品画像</th>
                <th scope="col">商品名</th>
                <th scope="col">価格</th>
                <th scope="col">在庫数</th>
                <th scope="col">メーカー名</th>
                <th>  <button type="button" class="regist" onclick="location.href='{{ route('new_product') }}'">新規登録</button></th>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td><img src="{{asset($product->image_path)}}" width="50" height="50"></td>

                <td>{{$product->product_name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->company->company_name}}</td>

                <!-- 詳細 -->
                <td>
                    <form action="{{ route('show', ['id'=>$product->id]) }}">
                        @csrf
                        <button type="submit" class="info">詳細</button>
                    </form>
                </td>

                <!-- 削除 -->
                <td>
                    <form action="{{ route('destroy', ['id'=>$product->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="delete">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>

        {{ $pages->links() }}
        </div>
    @endsection



