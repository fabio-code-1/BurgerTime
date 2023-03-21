
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





<!-- consultar cep -->
<script>
    function consultaCep(cep) {
        cep = cep.replace(/\D/g, '');
        if (cep != '') {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (data.hasOwnProperty('erro')) {
                        alert('CEP não encontrado');
                    } else {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    }
                }
            };
            xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/', true);
            xhr.send();
        }
    }

    document.getElementById('cep').addEventListener('blur', function() {
        consultaCep(this.value);
    });
</script>

<script>
    document.getElementById('bairro').addEventListener('change', function() {
        var frete = this.options[this.selectedIndex].getAttribute('data-frete');
        document.getElementById('valor_frete').value = frete;
    });
</script>
