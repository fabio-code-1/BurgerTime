@extends('layouts.app')

@section('content')
<h1>Carrinho</h1>
<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>R$ {{ number_format($item->product->price, 2, ',', '.') }}</td>
            <td>{{ $item->quantity }}</td>
            <td>R$ {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection