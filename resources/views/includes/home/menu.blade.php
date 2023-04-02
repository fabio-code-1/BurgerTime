<section id="menu" class="menu section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Menu</h2>
            <p>Confira Nosso Saboroso Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="menu-flters">
                    <li data-filter="*" class="filter-active">Tudo</li>
                    <li data-filter=".filter-snack">Lanches</li>
                    <li data-filter=".filter-drink">Refrigerantes</li>
                    <li data-filter=".filter-specialty">Combos</li>
                </ul>
            </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($products as $product)
            <div class="col-lg-6 menu-item {{$product->filter}}">
                <a href="#" class="menu-img-link" data-bs-toggle="modal" data-bs-target="#productModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-image="{{ asset('img/menu/' . $product->image) }}" data-description="{{ $product->description }}">
                    <img src="{{ asset('img/menu/' . $product->image) }}" class="menu-img" alt="">
                </a>

                <div class="menu-content">
                    <a href="#" class="product-name" data-bs-toggle="modal" data-bs-target="#productModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-image="{{ asset('img/menu/' . $product->image) }}" data-description="{{ $product->description }}">
                        {{ $product->name }}
                    </a>

                    <span>{{ number_format($product->price, 2, ',', '.') }}</span>
                </div>
                <div class="menu-ingredients">
                    {{ $product->description }}
                </div>
            </div>
            @endforeach

        </div>


    </div>
</section>


@if(Auth::check() && $cartCount > 0)
<div class="cart">
    <a href="{{ route('dashboard') }}" class="btn btn-info position-relative  btn-lg">
        Carrinho <i class="bi bi-cart4"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ $cartCount }}
        </span>
    </a>
</div>
@endif

@include('includes.home.modal')