@extends('layouts.app')

@section('content')
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
            <td>{{ $product->description }}</td>
            <td>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Adicionar produto</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(Auth::check() && $cartCount > 0)
    <a href="{{ route('dashboard') }}">Carrinho ({{ $cartCount }})</a>
@endif




@endsection