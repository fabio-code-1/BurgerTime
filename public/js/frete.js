// Evento para atualizar o campo hidden do valor do frete
document.getElementById('bairro').addEventListener('change', function() {
    var frete = this.options[this.selectedIndex].getAttribute('data-frete');
    document.getElementById('valor_frete').value = frete;
});