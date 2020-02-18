@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-left">
            @foreach($favoriteItems as $item)
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
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
