@extends('layouts.app')

@section('content')
<h1>dashboad</h1>

<h1>Carrinho</h1>

<a href="{{ route('cart.delete') }}">Apagar todos os itens do carrinho</a>
<h4>cadastrar endereço</h4>
<h4><a href="{{ route('endereco.create') }}">Cadastrar endereço</a></h4>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Total</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>R$ {{ number_format($item->product->price, 2, ',', '.') }}</td>
            <td>{{ $item->quantity }}</td>
            <td>R$ {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
            <td>
                <form method="POST" action="{{ route('cart.deleteOne', $item->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Total da compra : {{$totalPrice}}</h2>

<h3>Enviar pedido pelo WhatsApp</h3>
<a href="{{ route('whatsapp.send') }}" target="_blank" >Enviar pedido</a>




   



@endsection