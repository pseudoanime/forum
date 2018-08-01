@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse ($threads as $thread)
                    <div class="card">
                        <div class="card-header level">
                            <a class="flex" href="{{ $thread->path()}}">{{ $thread->title }}</a>
                            <strong>
                                <a href="{{$thread->path()}}">
                                    {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                                </a>
                            </strong>
                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>
                    <br>
                @empty
                    <p>There are no threads on this channel.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
