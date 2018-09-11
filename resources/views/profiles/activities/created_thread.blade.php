@component('profiles.activities.activity')
@slot('heading')
<a href="#"> {{ $profileUser->name }}</a>
published thread
<a href="{{$activity->subject->path()}}">
    {{ $activity->subject->title }}:
</a>
@endslot
@slot('body')
{{ $activity->subject->body }}
@endslot
@endcomponent
