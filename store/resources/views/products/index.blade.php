@extends('layout')

@section('content')
    <h1>Список продуктов</h1>
    <ul>
        @foreach($products as $product)
            <li>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100px;height:auto;">
                @endif
                {{ $product->name }} - {{ $product->price }} тг.
            </li>
        @endforeach
    </ul>
@endsection
