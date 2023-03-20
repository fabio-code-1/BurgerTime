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
    <div class="form-group">
        <label for="bairro">Bairro</label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $address->bairro }}" required>
    </div>
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