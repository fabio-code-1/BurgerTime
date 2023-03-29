$(document).ready(function() {
    $.scrollRestoration = 'auto'; // Habilita a restauração do scroll
    // Manipula o envio do formulário através do AJAX
    $('#add-to-cart-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
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
            error: function() {
                // Exibe uma mensagem de erro caso a requisição falhe
                alert('Ocorreu um erro ao adicionar o item ao carrinho.');
            }
        });
    });
});

