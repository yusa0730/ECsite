@extends('layouts.app')

@section('content')
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($checkitems as $checkitem)
                        <div class="card-header">
                            <a href="/item/{{ $checkitem->id }}">{{ $checkitem->name }}</a>
                        </div>
                        <div class="card-body">
                            <div>
                                {{ $checkitem->price }}円
                            </div>
                            <div class="form-inline">
                                <form method="POST" action="/checkitem/{{ $checkitem->id }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="text" class="form-control" name="quantity" value="{{ $checkitem->quantity }}">個
                                    <input type="hidden" name="item_id" value="{{ $checkitem->item_id }}">
                                    <button type="submit" class="btn btn-primary">更新</button>
                                </form>
                                <form method="POST" action="/checkitem/{{ $checkitem->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger ml-1">カートから削除する</button>
                                </form>
                                <!-- @if(Auth::id() === $checkitem->user_id)
                                    {!! Form::open(['route' => ['checkitem.destroy', $checkitem->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('カートから削除する', ['class' => 'btn btn-danger ml-1']) !!}
                                    {!! Form::close() !!}
                                @endif -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        小計
                    </div>
                    <div class="card-body">
                        {{ $subtotal }}円
                    </div>
                    @if($subtotal != 0)
                    <div>
                        <a class="btn btn-primary" href="/buy" role="button">
                            レジに進む
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
