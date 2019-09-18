@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($products as $product)
            <a href="buy/{{$product->id}}">
                <div>
                    {{$product->name}}<br>
                    {{$product->description}}<br>
                    {{$product->price}}
                </div>
            </a>
        @endforeach
    </div>
@endsection