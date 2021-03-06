<div class="card">
    <div class="card-header">
        <div class="level" class="flex">
            <h5 class="flex">
                <a href="{{ route('profiles', [$reply->owner->name]) }}">{{ $reply->owner->name }}</a>
                said {{ $reply->created_at->diffForHumans() }}
            </h5>
            <div>
                {{ Form::open(["url" => "/replies/ " .  $reply->id  . "/favorites"]) }}
                {{ Form::submit($reply->favorites_count . " " . str_plural("favorite", $reply->favorites_count), ["class" => "btn btn-default", $reply->isFavorited() ? 'disabled' : ""]) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
       <br>
       @can('update', $reply)
        {{ Form::open(['url' => "/replies/$reply->id", 'method' => 'delete'])}}
        {{ Form::submit('Delete')}}
        {{ Form::close()}}
       @endcan
    </div>
</div>
<br/>
