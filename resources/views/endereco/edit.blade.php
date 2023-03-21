<form method="POST" action="{{ route('address.update', $address->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" value="{{ $address->cep }}" required>
    </div>
    <div class="form-group">
        <label for="rua">Rua</label>
        <input type="text" class="form-control" id="rua" name="rua" value="{{ $address->rua }}" required>
    </div>
    <div class="form-group">
        <label for="numero">Número</label>
        <input type="text" class="form-control" id="numero" name="numero" value="{{ $address->numero }}">
    </div>
    <div class="form-group">
        <label for="complemento">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $address->complemento }}">
    </div>

    <select name="bairro" id="bairro" required>
        <option value="" selected>Selecione um bairro</option>
        @foreach($bairros as $bairro)
        <option value="{{ $bairro->nome }}" data-frete="{{ $bairro->valor_frete }}" @if($bairro->valor_frete == $address->frete) selected @endif>
            {{ $bairro->nome }} - {{ number_format($bairro->valor_frete, 2, ',', '.') }} R$
        </option>
        @endforeach
    </select>

    <input type="hidden" name="valor_frete" id="valor_frete" value="{{ $address->frete }}">

    <div class="form-group">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $address->cidade }}" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" value="{{ $address->estado }}" required>
    </div>
    <button type="submit">Salvar</button>
</form>

<script>
    // Evento para atualizar o campo hidden do valor do frete
    document.getElementById('bairro').addEventListener('change', function() {
        var frete = this.options[this.selectedIndex].getAttribute('data-frete');
        document.getElementById('valor_frete').value = frete;
    });
</script>