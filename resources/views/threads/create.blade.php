@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Thread</a></div>
                <div class="card-body">
                    @if($errors->count())
                    <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif
                    {{Form::open(["url" => "/threads"])}}
                        <div class="form-group">
                            <label for="channel_id">Choose a channel:</label>
                            <select name="chan disablednel_id" id="channel_id" class="form-control" required>
                                <option value='' disabled selected="selected">Choose One...</option>
                                @foreach(App\Channel::all() as $channel)
                                    <option value="{{ $channel->id}}" @if($channel->id==old('channel_id')) selected="selected" @endif>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="body">body:</label>
                            <textarea name="body" id="body" class="form-control" rows="8" required>{{ old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
