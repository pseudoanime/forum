@component('profiles.activities.activity')
@slot('heading')
<a href="#">{{ $profileUser->name }} </a>
 replied to a thread
<a href="{{$activity->subject->thread->path()}}">{{$activity->subject->thread->title}}
</a>:
{{ $activity->subject->title }}
@endslot
@slot('body')
{{ $activity->subject->body }}
@endslot
@endcomponent


