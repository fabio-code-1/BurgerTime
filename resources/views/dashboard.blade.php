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



<form method="get" action="{{ route('whatsapp.send') }}" target="_blank" formtarget="_blank">
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
    <input type="number" step="0.01" min="0" class="form-control money-input" id="change_amount_input" name="change_amount" style="display: none;">


    <br>

    <button type="submit" class="btn btn-primary">Enviar pedido</button>
</form>

<script>
    // obtém os elementos DOM necessários
    const paymentMethod = document.querySelector('#payment_method');
    const changeAmountLabel = document.querySelector('label[for="change_amount_input"]');
    const changeAmountInput = document.querySelector('#change_amount_input');

    // adiciona um evento de escuta para o campo "Forma de pagamento"
    paymentMethod.addEventListener('change', () => {
        if (paymentMethod.value === 'cash') {
            // se a forma de pagamento selecionada for "Dinheiro", mostra o campo "Total em dinheiro"
            changeAmountLabel.style.display = 'block';
            changeAmountInput.style.display = 'block';
        } else {
            // se a forma de pagamento selecionada não for "Dinheiro", esconde o campo "Total em dinheiro"
            changeAmountLabel.style.display = 'none';
            changeAmountInput.style.display = 'none';
        }
    });
</script>










@endsection