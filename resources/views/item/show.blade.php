@extends('adminlte::page')

@section('title', '商品一覧')


@section('content_header')
<h1>商品詳細</h1>
@stop

@section('content')
<div class="container border mt-2 p-4 ">
    <div class="row">
        <div class=" col-5">
            <img src="data:image/jpeg;base64,{{ $item->image }}" alt="画像がありません" class="mb-4 img-fluid  ">
        </div>
        <div class="col-7">
            <div class="mb-3 text-center"><label for="" class="me-2">商品ID:</label>{{$item->id}}</div>


            <div class="mb-3 text-center"><label for="" class="me-2">商品名:</label>{{$item->name}}</div>
            <div class="mb-3 text-center"><label for="" class="me-2">著者:</label>{{$item->author}}</div>
            <div class="mb-3 text-center"><label for="" class="me-2">商品種別:</label>{{$category[$item->type - 1 ]}}</div>
            <div class="mb-3 p-4">
                <p class="text-center">商品詳細</p>
                <div class="text-left border">{!! nl2br(htmlspecialchars($item->detail)) !!}</div>
            </div>
            <div class="mb-4 text-center w-70"><label for="" class="me-2">更新日時:</label>{{$item->updated_at}}</div>
            <div class="mb-3 text-center">
                @if (!Auth::user()->is_bookmark($item->id))
                <form action="{{ route('bookmark.store', $item) }}" method="post">
                    @csrf
                    <button>お気に入り登録</button>
                </form>
                @else
                <form action="{{ route('bookmark.destroy', $item) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>お気に入り解除</button>
                </form>
                @endif
            </div>
        </div>
    </div>




</div>
<div class=" container border p-4">
    <div class="row">
        <div class="col-6 ">


            <div class=" text-left">
                <h3 class="">カスタマーレビュー</h3>
                @foreach($reviews as $review)
                <div class="">
                    <h3 class="text-warning">{{ str_repeat("★",$review->score)}}</h3>
                    <p class="h3">{{$review->content}}</p>
                    <label>{{$review->created_at}} {{$review->user->name}}</label>
                </div>
                @endforeach
            </div><br />
        </div>

        <div class=" col-6 border-start">



            @auth
            <div class="">
                <div class="">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <h4>評価</h4>
                        <select name="score" class="form-control m-2 text-warning">
                            <option value="5" class="text-warning">★★★★★</option>
                            <option value="4" class="text-warning">★★★★</option>
                            <option value="3" class="text-warning">★★★</option>
                            <option value="2" class="text-warning">★★</option>
                            <option value="1" class="text-warning">★</option>
                        </select>
                        <h4>レビュー内容</h4>
                        @error('content')
                        <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" class="form-control m-2"></textarea>
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <button type="submit" class="btn  ml-2 btn-secondary">レビューを追加</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>

</div>

<form action="{{url('items/') }}" class="text-center">
    @csrf
    <input type="hidden" value="$item">
    <button class="btn btn-primary">戻る</button>
</form>
@stop

@section('css')
@stop

@section('js')
@stop