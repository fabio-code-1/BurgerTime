@extends('layouts.app')

@section('content')

<div class="toast align-items-center text-center mx-auto text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body w-auto">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>


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



<h2 class="text-center mb-3">Carrinho</h2>
<div class="cart">
    @if(count($cartItems) > 0)
        <a href="{{ route('cart.delete') }}" class="cart__clear">Apagar todos os itens do carrinho</a>
        <table class="cart__table">
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
    @else
    <p class="alert alert-info text-center">Carrinho está vazio</p>
    @endif
</div>


@if($cartItems->isNotEmpty())
<h2>Total da compra: {{ $totalPrice }}</h2>
@endif


<form method="get" action="{{ route('whatsapp.send') }}" target="_blank" formtarget="_blank" id="checkout-form">
    <!-- Seleção de forma de pagamento -->
    <label for="payment_method">Forma de pagamento</label>
    <select class="form-control" id="payment_method" name="payment_method">
        <option value="credit_card">Cartão de crédito</option>
        <option value="debit_card">Cartão de débito</option>
        <option value="pix">PIX</option>
        <option value="cash">Dinheiro</option>
    </select>
    <!-- Campo para informação do troco -->
    <label for="change_amount_input" style="display: none;">Total em dinheiro:</label>
    <input type="number" step="0.01" min="0" class="form-control money-input" id="change_amount_input" name="change_amount" style="display: none;" data-total-price="{{ $totalPrice }}">


    <br>

    <button type="submit" class="btn btn-primary">Enviar pedido</button>
</form>


<script>
    const successMessage = '{{ session("success") }}';
</script>
<script src="{{ asset('js/toast.js') }}" defer></script>
<script src="{{ asset('js/payment.js') }}" defer></script>

@endsection