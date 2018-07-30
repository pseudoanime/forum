@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>

            @foreach($profileUser->createdThreads as $thread)
                {{ $thread->title }}
            @endforeach
        </div>
    </div>
@endsection
