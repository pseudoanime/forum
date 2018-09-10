<div class="card">
    <div class="card-header">
        <div class="level">
            <span class="flex">
                        <a href="#"> {{ $profileUser->name }}</a>
                replied to a thread:
                {{ $activity->subject->title }}
</span>
            <span>{{$activity->created_at->diffForHumans()}}</span>
        </div>
    </div>
    <div class="card-body">
        {{ $activity->subject->body }}
    </div>
</div>

