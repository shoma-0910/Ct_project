@extends('layouts.user') @section('title', '商品一覧画面') @section('content')
<h1>商品一覧画面</h1>


    <div class="outside">
    <form action="{{ route('search') }}" method="GET" id="product_search">
    @csrf

    <input type="text" id="keyword" name="keyword" placeholder="検索キーワード" />


    <select name="company_id" >
    <option value="" >メーカー名</option>
    @foreach($companies as $company)
        <option value="{{ $company->id }}" >
          {{$company->company_name}}
        </option>
    @endforeach
    </select>
 


    <div class="price.search">
    <p>{{ __('価格') }}</p>

    <p>{{ __('上限') }}</p>
    <input type="number" id="maxPrice" name="maxPrice" value="">

    <p>{{ __('下限') }}</p>
    <input type="number" id="minPrice" name="minPrice"  value="">

    </div>

    <div class="stock.search">
    <p>{{ __('在庫数') }}</p>

    <p>{{ __('上限') }}</p>
    <input type="number" id="maxStock" name="maxStock" value="">

    <p>{{ __('下限') }}</p>
    <input type="number" id="minStock" name="minStock" value="">

    </div>

    <input type="submit" class="button" id="search" value="検索" />

    </form>
    </div>





<div id="product_table">
    <table id="myTable" class="tablesorter" style="width: 1000px; max-width: 0 auto;">
    <thead>
            <tr class="table-info" id="product_info">
                <th scope="col">id</th>
                <th scope="col">商品画像</th>
                <th scope="col">商品名</th>
                <th scope="col">価格</th>
                <th scope="col">在庫数</th>
                <th scope="col">メーカー名</th>
                <th>  <button type="button" class="regist" onclick="location.href='{{ route('new_product') }}'">新規登録</button></th>
            </tr>
            </thead>
        <tbody>
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
                    <form action="{{ route('destroy', ['id'=>$product->id]) }}" method="post">
                        @csrf
                        <button type="submit" id="delete" class="delete" data-product_id="{{$product->id}}" >削除</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

{{ $pages->links() }}
</div>
</div>
@endsection



