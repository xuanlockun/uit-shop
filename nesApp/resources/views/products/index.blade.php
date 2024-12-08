<x-app-layout>

    <section id="page-header">
        <h2>#Rawr</h2>
        <p>Save more with coupons & up to 70% off!</p>
    </section>
    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <form action="{{ route('products') }}" method="GET" id="couponForm" class="mb-4">
                <div class="input-group">
                    <input type="text" id="couponCode" name="q" class="form-control" placeholder="Tìm sản phẩm..." value="{{ request()->input('q') }}">
                    <button class="normal" type="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </section>
    <section id="product1" class="section-p1">
        <h2>Bộ sưu tập áo mi</h2>
        <p>Khám phá các mẫu áo sơ mi độc đáo và sống động với họa tiết ấn tượng.</p>
        <div class="pro-container">
            @foreach ($products as $product)
                <div class="pro">
                    <a href="{{ route('products.detail', $product->id) }}">
                        <img src="{{ $product->image }}" alt="">
                        <div class="des">
                            <span>{{ $product->name }}</span>
                            <h5>{{ $product->name }}</h5>
                            <div class="star">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $product->star)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <h4>${{ $product->price }}</h4>
                        </div>
                    </a>
                    <a href="#" class="cart-link"><i class="fas fa-shopping-cart cart"></i></a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
        </section> --}}

    <section id="pagination" class="section-p1">
        @if ($products->hasPages())
            @if ($products->onFirstPage())
                <a class="disabled">1</a>
            @else
                <a href="{{ $products->previousPageUrl() }}">1</a>
            @endif

            @for ($i = 2; $i <= $products->lastPage(); $i++)
                @if ($i === $products->currentPage())
                    <span class="current">{{ $i }}</span>
                @else
                    <a href="{{ $products->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}">
                    <i class="fas fa-long-arrow-alt-right"></i>
                </a>
            @endif
        @endif
    </section>

</x-app-layout>
