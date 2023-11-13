@extends('adminlte::page')

@section('title', '商品一覧')


@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="container mb-4">
    <form method="GET" action="{{url('items/search')}}">
        @csrf
        <div class=" form-group ">
        <h3 class="text-center">商品検索</h3>
        <input name="keyword" type="text" placeholder="キーワードを入力してください" class="form-control mb-1">
        
        <select class="form-control" id="category-id" name="category_id">
          <option value="0">ジャンルを選択してください</option>
          <option value="1">ビジネス</option>
          <option value="2">小説</option>
          <option value="3">漫画</option>
          <option value="4">趣味・実用</option>
          <option value="5">雑誌・ムック</option>
          <option value="6">専門書</option>
          <option value="7">学習参考書</option>
        </select>
        <div class="text-center mt-3">
        <input type="submit" value="検索" class="btn btn-primary">
        </div>
        
        </div>
        
    </form>
    </div>
                
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>著者</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>商品編集</th>
                                <th>商品削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td><a href="items/show/{{$item->id}}">詳細</a></td>
                                    <td><a href="items/edit/{{$item->id}}"><i class="bi bi-pencil-square"></i> 編集</a></td>
                                    <td><a href="items/delete/{{$item->id}}" onclick="return confirm('商品を削除しますか？');">
                                    <i class="bi bi-trash3"></i> 削除</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
