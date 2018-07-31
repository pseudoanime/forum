@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>

            @forelse($threads as $thread)
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                        <a href="#"> {{ $profileUser->name }}</a> posted:
                                {{ $thread->title }}
                            </span>
                            <span>{{$thread->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
                {{ $threads->links() }}
            @empty
                There are no threads for this user yet.
            @endforelse
        </div>
    </div>
@endsection
