@extends('layouts.app')

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-left">
            @foreach($items as $item)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <a href="/item/{{ $item->id }}">{{ $item->name }}</a>
                    </div>
                    <div class="card-body">
                        <p>在庫数</p>{{ $item->stock}}
                    </div>
                    <div class="card-body">
                        <p>値段</p>{{ $item->price }}円
                    </div>
                    @auth
                    @if($item->stock != 0)
                        <form method="POST" action="checkitem" class="form-inline m-1">
                            {{ csrf_field() }}
                            <select name="quantity" class="form-control col-md-2 mr-1">
                                <option selected>1</option>}
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <input id="{{ $item->id }}" name="item" type="hidden" value="secret">
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-primary col-md-6">カートに入れる</button>
                        </form>
                    @else
                        <div class="card-body">
                            <p style="color: red;">売り切れ</p>
                        </div>
                    @endif
                        <div>
                            @if (Auth::user()->is_favorite($item->id))
                                {!! Form::open(['route' => ['favorites.unfavorite', $item->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('お気に入りを外す', ['class' => "button btn btn-warning"]) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['favorites.favorite', $item->id]]) !!}
                                    {!! Form::submit('お気に入り', ['class' => "button btn btn-success"]) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            {{ $items->appends(['keyword' => Request::get('keyword')])->links() }}
        </div>
    </div>
@endsection
