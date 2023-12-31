@extends('adminlte::page')

@section('title', '商品一覧')

@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
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
                        <h3 class="text-center mt-3">商品検索</h3>
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
                @can("admin")
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                        </div>
                    </div>
                </div>
                @endcan
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
                            @can("admin")
                            <th>商品編集</th>
                            <th>商品削除</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->author }}</td>
                            <td>@switch($item->type)
                                @case(1)
                                ビジネス
                                @break
                                @case(2)
                                小説
                                @break
                                @case(3)
                                漫画
                                @break
                                @case(4)
                                趣味・実用
                                @break
                                @case(5)
                                雑誌・ムック
                                @break
                                @case(6)
                                専門書
                                @break
                                @case(7)
                                学習参考書
                                @break
                                @endswitch
                            </td>
                            <td><a href="{{route('item.show',['id' => $item->id  ])}}">詳細</a></td>
                            @can("admin")
                            <td><a href="{{route('item.edit',['id' => $item->id  ])}}}}"><i class="bi bi-pencil-square"></i> 編集</a></td>
                            <td><a href="{{route('item.delete',['id' => $item->id  ])}}" onclick="return confirm('商品を削除しますか？');">
                                    <i class="bi bi-trash3"></i> 削除</a></td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 <!-- ページネーションを表示 -->
                 <div class="paginationWrap">
                    {{ $items->links() }}
                    
                </div>

            </div>



        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop