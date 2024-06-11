@extends('layout')

@section('content')
    <h1>Подтвердите удаление продукта</h1>
    <p>Вы уверены, что хотите удалить продукт "{{ $product->name }}"?</p>
    <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить продукт</button>
    </form>    
@endsection