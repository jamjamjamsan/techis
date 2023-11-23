@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>お気に入り一覧</h1>
@stop

@section('content')
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>著者</th>
                <th>種別</th>
                <th>詳細</th>

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
                <td><a href="items/show/{{$item->id}}">詳細</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop