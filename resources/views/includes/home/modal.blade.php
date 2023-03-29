<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger product-name" id="productModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="menu-img" alt="">
                <div class="product-info">
                    <p class="text-dark product-price"></p>
                    <p class="text-dark product-description"></p>
                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id">
                        <p class="text-dark">Quantidade</p>
                        <input type="number" name="quantity" value="1" min="1">
                        <button type="submit">Adicionar produto</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/modal.js') }}" defer></script>
<script src="{{ asset('js/form-modal.js') }}" defer></script>