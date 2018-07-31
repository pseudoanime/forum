@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{  route("profiles", [$thread->creator->name])}}"> {{ $thread->creator->name}}</a>
                        posted:
                        {{ $thread->title }}
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
                @foreach ($replies as $reply)
                    @include('threads.reply')
                @endforeach
                {{ $replies->links() }}
                <br>
                @auth
                {{ Form::open(["url" => $thread->path() . "/replies"]) }}
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"
                              rows="5"></textarea>
                </div>
                {{ Form::submit('Post') }}
                {{ Form::close() }}
                @else
                    <p class="text-center">Please <a href=" {{ route('login') }}">Sign In</a> to participate in this
                        discussion.</p>
                    @endauth
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }} by <a
                                href="#"> {{ $thread->creator->name }}</a> and currently
                        has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
