@extends('layout')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>{{ $product->price }}</p>
    @if ($product->image)
        @php
            $base64Image = base64_encode($product->image);
        @endphp
        <img src="data:image/jpeg;base64,{{ $base64Image }}" alt="Изображение продукта">
    @endif
@endsection
