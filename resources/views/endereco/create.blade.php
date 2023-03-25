
<form method="POST" action="{{ route('address.store') }}">
    @csrf
    <div class="form-group">
        <label for="cep">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" required>
    </div>
    <div class="form-group">
        <label for="rua">Rua</label>
        <input type="text" class="form-control" id="rua" name="rua" required>
    </div>
    <div class="form-group">
        <label for="numero">Número</label>
        <input type="text" class="form-control" id="numero" name="numero" required>
    </div>
    <div class="form-group">
        <label for="complemento">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento">
    </div>
    <div class="form-group">
        <label for="bairro">Bairro:</label>

        <select name="bairro" id="bairro" required>
            <option value="" selected>Selecione um bairro</option>
            @foreach($bairros as $bairro)
            <option value="{{ $bairro->nome }}" data-frete="{{ $bairro->valor_frete }}">
                {{ $bairro->nome }} - {{ number_format($bairro->valor_frete, 2, ',', '.') }} R$
            </option>
            @endforeach
        </select>
        <input type="hidden" name="valor_frete" id="valor_frete">
    </div>
    <div class="form-group">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" required>
    </div>
    <button type="submit">Salvar</button>
</form>


<script src="{{ asset('js/cep.js') }}" defer></script>

