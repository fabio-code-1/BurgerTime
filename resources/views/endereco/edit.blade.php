@extends('layouts.app')

@section('content')

<div style="height: 140px; width:100%; background:#1a1814;"></div>

<section id="formulario" style="background-color: #353129;">

    <div class="container mt-5">
        <h2 class="text-center mb-4" style="font-weight:bold; color:#cda45e;">Editar Endereço</h2>
        <form method="POST" action="{{ route('address.update', $address->id) }}" style="max-width: 500px; margin: 0 auto;">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" value="{{ $address->cep }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="rua">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" value="{{ $address->rua }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="numero">Número da Casa</label>
                <input type="text" class="form-control" id="numero" name="numero" value="{{ $address->numero }}">
            </div>
            <div class="form-group mb-3">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $address->complemento }}" placeholder="Opcional">
            </div>

            <div class="form-group mb-3">
                <label for="bairro">Bairro</label>
                <select name="bairro" id="bairro" class="form-select" required>
                    <option value="" selected>Selecione um bairro</option>
                    @foreach($bairros as $bairro)
                    <option value="{{ $bairro->nome }}" data-frete="{{ $bairro->valor_frete }}" @if($bairro->valor_frete == $address->frete) selected @endif>
                        {{ $bairro->nome }} - {{ number_format($bairro->valor_frete, 2, ',', '.') }} R$
                    </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="valor_frete" id="valor_frete" value="{{ $address->frete }}">

            <div class="form-group mb-3">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $address->cidade }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="{{ $address->estado }}" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mb-5">Salvar</button>
            </div>
        </form>
    </div>

</section>

<script src="{{ asset('js/frete.js') }}" defer></script>

@endsection