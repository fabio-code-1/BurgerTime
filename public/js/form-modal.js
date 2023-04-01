$(document).ready(function () {
    $.scrollRestoration = 'auto'; // Habilita a restauração do scroll
    // Manipula o envio do formulário através do AJAX
    $('#add-to-cart-form').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var input = form.find('.quantity-input');
        var currentValue = parseInt(input.val());
        form.append('<input type="hidden" name="quantity" value="' + currentValue + '">'); // Adiciona um campo hidden com o valor atualizado
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                // Manipula a resposta do servidor
                console.log(response);
                // Fecha o modal
                $('.modal').modal('hide');
                // Armazena a posição atual do scroll
                var scrollPosition = $(window).scrollTop();
                // Recarrega a página
                window.location.reload();
                // Restaura a posição do scroll após a recarga da página
                $(window).scrollTop(scrollPosition);
            },
            error: function () {
                // Redireciona o usuário para a página de login caso a requisição falhe
                window.location.href = "/login";
            }
        });
    });
});

$('.minus-btn').click(function () {
    console.log('Botão de diminuir clicado');
    // Obtém o valor atual do input
    var input = $(this).parent().siblings('.quantity-input');
    var currentValue = parseInt(input.val());

    // Verifica se o valor atual é maior que 1
    if (currentValue > 1) {
        // Diminui o valor
        input.val(currentValue - 1);
    }
});

$('.plus-btn').click(function () {
    console.log('Botão de aumentar clicado');
    // Obtém o valor atual do input
    var input = $(this).parent().siblings('.quantity-input');
    var currentValue = parseInt(input.val());

    // Aumenta o valor
    input.val(currentValue + 1);
});
