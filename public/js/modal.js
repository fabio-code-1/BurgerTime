$('#productModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var product_id = button.data('id')
    var product_name = button.data('name')
    var product_price = button.data('price')
    var product_image = button.data('image')
    var product_description = button.data('description')
    var modal = $(this)
    modal.find('.product-name').text(product_name)
    modal.find('.product-price').text(product_price.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}));
    modal.find('.product-description').text(product_description)
    modal.find('.menu-img').attr('src', product_image)
    modal.find('#product_id').val(product_id)
})

