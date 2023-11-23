@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
<h1>商品編集</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <form action= "/items/update" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <p>商品ID：{{$item->id}}</p>
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ old('name', $item->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="author">著者</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="著者" value="{{ old('author', $item->author) }}">
                    </div>

                    <div class="form-group">
                        <label for="type">種別</label>
                        <select class="form-control" id="type" name="type" value="{{ old('type') }}">
                            <option value="0">ジャンルを選択してください</option>
                            <option value="1" {{ old("type", $item->type) == 1 ? "selected" : "" }}>ビジネス</option>
                            <option value="2" {{ old("type", $item->type) == 2 ? "selected" : "" }}>小説</option>
                            <option value="3" {{ old("type", $item->type) == 3 ? "selected" : "" }}>漫画</option>
                            <option value="4" {{ old("type", $item->type) == 4 ? "selected" : "" }}>趣味・実用</option>
                            <option value="5" {{ old("type", $item->type) == 5 ? "selected" : "" }}>雑誌・ムック</option>
                            <option value="6" {{ old("type", $item->type) == 6 ? "selected" : "" }}>専門書</option>
                            <option value="7" {{ old("type", $item->type) == 7 ? "selected" : "" }}>学習参考書</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <textarea name="detail" class="form-control" style="height: 192px;">{{ old('detail' , $item->detail) }}</textarea>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="image">商品画像</label>
                        <div class="imageWrap">
                            @if ($item->image)
                            <img src="data:image/jpeg;base64,{{ $item->image }}" alt="商品画像" style="margin-top: 10px;">
                            @else
                            <p>写真は登録されていません</p>
                            @endif
                        </div>
                        <!-- file形式　  accept="image/jpg"(jpgのみアップロード可能) -->
                        <input type="file" class="form-control-file" name="image" accept="image/jpeg,image/jpg" style="margin-top: 10px;">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
















@section('css')
@stop

@section('js')
@stop