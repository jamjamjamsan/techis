@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">書籍管理システム</h1>
@stop

@section('content')
    <div class="text-center">
        <p>書籍管理システムへようこそ</p>
        <img src="{{ asset('images/book.jpeg') }}" alt="" class="img-fluid">
    </div>
    
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
