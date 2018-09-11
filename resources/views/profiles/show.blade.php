@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>{{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                    @forelse($activities as $date => $groupedActivities)
                        <h3 class="page-header">{{$date}}</h3>
                        @foreach($groupedActivities as $activity)
                            @include('profiles.activities.' .$activity->type, ['activity' => $activity])
                            <br>
                        @endforeach
                        {{--                        {{ $activities->links() }}--}}
                    @empty
                        There are no threads for this user yet.
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
