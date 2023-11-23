@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>ブックマーク一覧</h1>
@stop

@section('content')
<div class="container">
    <h1 class="center-block bg-success text-white text-center" >ユーザー編集</h1>
    <h2>「{{$user->name}}さん」現在の権限:@if($user->role === 1) 利用者 @else 管理者 @endif</h2>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/user/update" method="post">
        @CSRF
        <input class="form-control" type="hidden" name="id" value="{{$user->id}}">

        <button type="button" class="btn btn-secondary" onclick="location.href='/user'">ユーザー一覧に戻る</button>

        <div class="form-group">
            <label for="name">名前</label>
            <input class="form-control" type="text" name="name" value="{{ old('name',$user->name) }}">
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input class="form-control" type="email" name="email" value="{{ old('email',$user->email) }}">
        </div>
        <div class="form-group">
            <label for="role" class="form-label">権限</label><br>
            <label class="radio-inline">
                <input type="radio" name="role" value="1" @if($user->role==1) checked @endif>利用者
            </label>
            <label class="radio-inline">
                <input type="radio" name="role" value="2" @if($user->role==2) checked @endif>管理者
            </label>
        </div>
        <!-- 更新ボタン -->
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
            </svg>更新
        </button>
        <!-- 削除ボタン -->
        <a href="/user/delete/{{$user->id}}">
            <button type="button" class="btn btn-danger " onclick="return confirm('本当に削除しますか？')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>削除
            </button>
        </a>
    </form>
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