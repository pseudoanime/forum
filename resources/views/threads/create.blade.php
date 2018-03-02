@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Thread</a></div>
                <div class="card-body">
                    {{Form::open(["url" => "/threads"])}}
                        <div class="form-group">
                            <label for="title">title:</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">body:</label>
                            <textarea name="body" id="body" class="form-control" rows="8"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
