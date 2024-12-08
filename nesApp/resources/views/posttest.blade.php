<x-app-layout>
    <h1>Danh sách bài viết</h1>
    @foreach ($posts as $post)
    <section id="" class="section-p1 section-m1">
            <h2>{{ $post->title }}</h2>
            <p>{{ \Str::limit($post->content, 100) }}</p>
            {{-- <a href="{{ route('posts.show', $post->slug) }}">Đọc thêm</a> --}}
    </section>
    <section id="product1" class="section-p1">
        {{-- <h2>Bộ sưu tập áo mi</h2>
        <p>Khám phá các mẫu áo sơ mi độc đáo và sống động với họa tiết ấn tượng.</p> --}}
        <div class="pro-container">
            @foreach ($posts as $post)
                <div class="pro">
                    <a href="{{ route('products.detail', $post->id) }}">
                        <img src="{{ $post->image }}" alt="">
                        <div class="des">
                            <span>{{ $post->title }}</span>
                            <h5>{{ $post->title }}</h5>
                            {{-- {!! $post->content !!} --}}
                            <h4>{{ $post->short }}</h4>
                        </div>
                    </a>
                    <a href="#" class="cart-link"><i class="fas fa-shopping-cart cart"></i></a>
                </div>
            @endforeach
        </div>
    </section>
    @endforeach
</x-app-layout>