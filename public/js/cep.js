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

if (document.getElementById('cep')) {
    document.getElementById('cep').addEventListener('blur', function() {
        consultaCep(this.value);
    });
}

if (document.getElementById('bairro')) {
    document.getElementById('bairro').addEventListener('change', function() {
        var frete = this.options[this.selectedIndex].getAttribute('data-frete');
        document.getElementById('valor_frete').value = frete;
    });
}
