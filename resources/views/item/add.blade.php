@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
<h1>商品登録</h1>
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
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="author">著者</label>
                        <input type="text" class="form-control" id="author" name="author" placeholder="著者" value="{{ old('author') }}">
                    </div>

                    <div class="form-group">
                        <label for="type">種別</label>
                        <!--<input type="text" class="form-control" id="type" name="type" placeholder="種別">-->
                        <select class="form-control" id="type" name="type" value="{{ old('type') }}">
                            <option value="0">ジャンルを選択してください</option>
                            <option value="1" @if(old('type')==1) selected @endif>ビジネス</option>
                            <option value="2" @if(old('type')==2) selected @endif>小説</option>
                            <option value="3" @if(old('type')==3) selected @endif>漫画</option>
                            <option value="4" @if(old('type')==4) selected @endif>趣味・実用</option>
                            <option value="5" @if(old('type')==5) selected @endif>雑誌・ムック</option>
                            <option value="6" @if(old('type')==6) selected @endif>専門書</option>
                            <option value="7" @if(old('type')==7) selected @endif>学習参考書</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明" value="{{ old('detail') }}">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="image">画像アップロード（jpg／jpeg）</label>
                        <!-- file形式　   -->
                        <input type="file" name="image" accept="image/jpeg,image/jpg">
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