@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>購入商品</h3>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($checkitems as $cartitem)
                        <div class="card-header">
                            <a>{{ $cartitem->name }}</a>
                        </div>
                        <div class="card-body">
                            <div>
                                {{ $cartitem->price }}円
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                {{ $cartitem->quantity }}
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
                </div>
            </div>
        </div>
    </div>
@endsection

