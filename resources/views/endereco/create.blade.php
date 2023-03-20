<form method="POST" action="{{ route('address.store') }}">
    @csrf

    <div>
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua">
    </div>

    <div>
        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero">
    </div>

    <div>
        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento">
    </div>

    <div>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade">
    </div>

    <div>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado">
    </div>

    <div>
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep">
    </div>

    <button type="submit">Salvar</button>
</form>
