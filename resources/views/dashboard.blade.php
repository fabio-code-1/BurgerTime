@extends('layouts.app')

@section('content')

<div style="height: 140px; width:100%; background:#1a1814;"></div>

@if(isset($endereco))
<div class="text-center mx-auto mb-5 mt-3">
    <h4>Seu Endereço:</h4>
    <p class="small">{{ $endereco->rua }}, {{ $endereco->numero }}, {{ $endereco->complemento }}</p>
    <p class="small">{{ $endereco->cidade }} - {{ $endereco->estado }}, {{ $endereco->cep }}</p>
    <p class="small">Valor do frete: R$ {{ number_format($endereco->frete, 2, ',', '.') }}</p>
    <a href="{{ route('endereco.edit', ['id' => $endereco->id]) }}">Editar Endereço</a>
</div>
@else
<h4 class="text-center mb-5">
    Cadastrar Endereço
    <a href="{{ route('endereco.create') }}">clique aqui!</a>
</h4>
@endif


<section id="carrinho-section">
    <h2 class="text-center mb-3">Carrinho</h2>
    <div class="cart-user">
        @if(count($cartItems) > 0)
        <div class="text-center">
            <a href="{{ route('cart.delete') }}" class="cart__clear">Apagar todos os itens do carrinho!</a>
        </div>

        <div class="d-flex justify-content-center">
            <table class="table  text-light text-center" style="width: 1500px;">
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
                                <button type="submit" class="btn btn-danger btn-excluir">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        @else
        <p class="alert alert-info text-center">Carrinho está vazio</p>
        @endif
    </div>



    @if($cartItems->isNotEmpty())
    <h6 class="text-center">Total da compra: R$ {{ number_format($totalPrice, 2, ',', '.') }}</h6>
    @endif


    <form method="get" action="{{ route('whatsapp.send') }}" target="_blank" formtarget="_blank" id="checkout-form" class="text-center mt-5">
        <div class="form-group row justify-content-center">
            <label for="payment_method" class="col-sm-2 col-form-label"><abbr title="A forma de pagamento só pode ser liberado sem conter algo no carrinho!" class="initialism">Forma de pagamento</abbr></label>
            <div class="col-sm-6">
                <select class="form-select" id="payment_method" name="payment_method" {{ count($cartItems) == 0 ? 'disabled' : '' }}>
                    <option value="credit_card">Cartão de crédito</option>
                    <option value="debit_card">Cartão de débito</option>
                    <option value="pix">PIX</option>
                    <option value="cash">Dinheiro</option>
                </select>


            </div>
        </div>

        <div class="form-group row justify-content-center">
            <label for="change_amount_input" class="col-sm-2 col-form-label" style="display: none;">Total em dinheiro:</label>
            <div class="col-sm-6">
                <input type="number" step="0.01" min="0" class="form-control money-input" id="change_amount_input" name="change_amount" style="display: none;" data-total-price="{{ $totalPrice }}">
            </div>
        </div>

        <div class="form-group row justify-content-center">
            <div class="col-sm-8">
                @if ($endereco)
                <button type="submit" class="btn btn-primary {{ count($cartItems) == 0 ? 'disabled' : '' }} mt-3 mb-5">Enviar pedido</button>
                @else
                <p class="mt-3 bg-dark text-warning">Você precisa cadastrar um endereço antes de enviar o pedido.</p>
                @endif

            </div>
        </div>
    </form>

</section>

<script>
    const successMessage = '{{ session("success") }}';
</script>
<script src="{{ asset('js/toast.js') }}" defer></script>
<script src="{{ asset('js/payment.js') }}" defer></script>

@endsection