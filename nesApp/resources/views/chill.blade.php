<x-app-layout>
    <section id="hero">
        <h4>uit project</h4>
        <h2>Website bán quần áo</h2>
        <h1>Online</h1>
        <p>Khuyến mãi và giảm giá hấp dẫn tới 10%!</p>
        <button>Mua ngay</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="">
            <h6>Miễn phí vận chuyển</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="">
            <h6>Nhanh chóng</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f3.png" alt="">
            <h6>Tiết kiệm</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f4.png" alt="">
            <h6>Khuyến mãi</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="">
            <h6>Thân thiện</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="">
            <h6>Hỗ trợ 24/7</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Bộ sưu tập áo mi</h2>
        <p>Khám phá các mẫu áo sơ mi độc đáo và sống động với họa tiết ấn tượng.</p>
        <div class="pro-container">
            @php
                $count = 0;
            @endphp
            @foreach ($products as $product)
                @if ($count < 4)
                    <div class="pro">
                        <a href="{{ route('products.detail', $product->id) }}">
                            <img src="{{ $product->image }}" alt="">
                            <div class="des">
                                <span>{{ $product->name }}</span>
                                <h5>{{ $product->name }}</h5>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $product->star)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <h4>${{ $product->price }}</h4>
                            </div>
                        </a>
                        <a href="#" class="cart-link"><i class="fas fa-shopping-cart cart"></i></a>
                    </div>
                    @php
                        $count++;
                    @endphp
                @endif
            @endforeach
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Khuyến mãi</h4>
        <h2>Dùng mã <span>10% - UIT</span> - để được giảm giá </h2>
        <button class="normal">Mua ngay</button>
    </section>

    <!--New Arrival-->
    <section id="product1" class="section-p1">
        <h2>Bộ sưu tập quần áo</h2>
        <p>Khám phá các mẫu quần áo độc đáo và sống động với họa tiết ấn tượng.</p>
        <div class="pro-container">
            @php
                $count = 0;
            @endphp
            @foreach ($products as $index => $product)
                @if ($index >= 4 && $count < 12)
                    <div class="pro" id="{{ $product->id }}">
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
                    @php
                        $count++;
                    @endphp
                @endif
            @endforeach
        </div>
    </section>


    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Khuyến Mãi Đặc Biệt</h4>
            <h2>Giảm giá 5%</h2>
            <span>Khuyến mãi đặc biệt cho những khách hàng ở thành phố Hồ Chí Minh</span>
            <button class="white">Xem ngay</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Phối đồ</h4>
            <h2>Các cách phối đồ</h2>
            <span>Các kiểu phối đồ đẹp nhất</span>
            <button class="white">Xem ngay</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>Khuyến mãi</h2>
            <h3>Giảm giá - 50%</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Đa dạng</h2>
            <h3>Đa dạng quần áo</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Thân thiện</h2>
            <h3>Chat 24/7</h3>
        </div>
    </section>

</x-app-layout>
