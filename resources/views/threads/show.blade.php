@extends('layouts.app')

@section('content')
<div class="container">
        <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                    <a href="#"> {{ $thread->creator->name}}</a> posted:
                        {{ $thread->title }}
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
        </div>
        <br>
        <div class="col-md-8 mx-auto">
         @foreach ($thread->replies as $reply)
            @include('threads.reply')
        @endforeach
        </div>
        @auth
        <div class="col-md-8 mx-auto">
            {{ Form::open(["url" => $thread->path() . "/replies"]) }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                </div>
                {{ Form::submit('Post') }}
            {{ Form::close() }}
        </div>
        @else
        <p class="text-center">Please <a href=" {{ route('login') }}">Sign In</a> to participate in this discussion.</p>
        @endauth
</div>
@endsection
