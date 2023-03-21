@extends('layouts.app')

@section('content')

@if(isset($endereco))
<h4>
    Seu Endereço:
</h4>
    <p>{{ $endereco->rua }}, {{ $endereco->numero }}, {{ $endereco->complemento }}</p>
    <p>{{ $endereco->cidade }} - {{ $endereco->estado }}, {{ $endereco->cep }}</p>
    <!-- Exibindo o valor do frete -->
    <p>Valor do frete: R$ {{ number_format($endereco->frete, 2, ',', '.') }}</p>

    <a href="{{ route('endereco.edit', ['id' => $endereco->id]) }}">Editar Endereço</a>
@else
    <h4>
        Cadastrar Endereço
        <a href="{{ route('endereco.create') }}">clique aqui!</a>
    </h4>
@endif



<h2>Carrinho</h2>
<a href="{{ route('cart.delete') }}">Apagar todos os itens do carrinho</a>
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

@if($cartItems->isNotEmpty())
    <h2>Total da compra: {{ $totalPrice }}</h2>
@endif


<h3>Enviar pedido pelo WhatsApp</h3>
<a href="{{ route('whatsapp.send') }}" target="_blank">Enviar pedido</a>








@endsection