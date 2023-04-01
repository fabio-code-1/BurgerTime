<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title  product-name" id="productModalLabel"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="menu-img w-100 img-fluid" alt="">
                <div class="product-info">
                    <p class="paragrafh-model">Valor do Produto: <span class="product-price"></span></p>
                    <p class=" paragrafh-model">Ingredientes: <span class="product-description"></span></p>
                    <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id">
                        <p class="paragrafh-model text-center">Quantidade</p>

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary minus-btn ms-5" type="button"><i class="bi bi-dash"></i></button>
                            </div>
                            <input type="text" class="form-control text-center quantity-input mx-3" value="1" aria-label="Quantidade">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary plus-btn me-5" type="button"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-success text-center">Adicionar produto</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="{{ asset('js/modal.js') }}" defer></script>
<script src="{{ asset('js/form-modal.js') }}" defer></script>