@extends('layouts.app')

@section('content')
@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{session('flash_message')}}
    </div>
@endif
<div class="container">
        <div class="row justify-content-left">
            @foreach($messages as $message)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <p>{{ $message->created_at }}</p>
                    </div>
                    <div class="card-header">
                        by<p>{{ $message->user->name }}</p>さんの口コミ
                    </div>
                    <div class="card-body">
                        {{ $message->content}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <ul class="list-unstyled">
            @foreach ($messages as $message)
              <li class="media mb-3">
                <div class="media-body">
                    <div>
                        <span class="text-muted">posted at {{ $message->created_at }}</span>
                    </div>
                    <div>
                        <p class="mb-0">{!! nl2br(e($message->content)) !!}</p>
                    </div>
                    <div>
                        @if (Auth::id() == $message->user_id)
                            {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
              </li>
            @endforeach
            </ul>
            @if (Auth::id() == $user->id)
                <!-- <form action="/messages" method="POST" class="form-group">
                    @csrf
                    <input type="text" class="form-control" name="content" value="{{ old('content') }}">
                    <button type="submit" class="btn btn-primary btn-block">投稿する</button>
                </form> -->
                    {!! Form::open(['route' => 'messages.store']) !!}
                        <div class="form-group">
                             {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>

@endsection

