<x-app-layout>
    {{-- @php
    var_dump($product);
    @endphp --}}

    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="{{ asset($product->image) }}" width="100%" id="MainImg" alt="">
        </div>
        <div class="single-pro-details">
            <h6>Home / {{ $product->category }}</h6>
            <h4>{{ $product->name }}</h4>
            <h2>${{ number_format($product->price, 2) }}</h2>
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="product_image" value="{{ $product->image }}">
                <input type="hidden" name="product_name" value="{{ $product->name }}">
                <input type="hidden" name="product_price" value="{{ $product->price }}">
    
                <select name="size" required>
                    <option value="">Select Size</option>
                    @foreach($product->sizes as $size)
                        <option value="{{ $size->size }}">
                            {{ $size->size }} 
                            @if($size->stock > 0)
                                - Stock: {{ $size->stock }}
                            @else
                                - Out of Stock
                            @endif
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantity" value="1" min="1" required>
                <button class="normal" type="submit">Add To Cart</button>
            </form>
            <h4>Details</h4>
            <span>{{ $product->description }}</span>
        </div>
    </section>
    
    <section class="section-p1">
        <div class="reviews">
            <h2>Đánh giá:</h2>
            @foreach ($product->reviews as $review)
                <div class="review">
                    <p><strong>Khách hàng: {{ $review->user->name }}</strong></p>
                    <p>{{ $review->content }}</p>
                    <p>Đánh giá: 
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->star_rating)
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </p>
                </div>
            @endforeach
        </div>
        @auth
            
        <form action="{{ route('reviews.store') }}" method="POST" class="review-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="star-rating" id="star-rating">
                <i class="star fas fa-star" data-value="1"></i>
                <i class="star fas fa-star" data-value="2"></i>
                <i class="star fas fa-star" data-value="3"></i>
                <i class="star fas fa-star" data-value="4"></i>
                <i class="star fas fa-star" data-value="5"></i>
            </div>
            <input type="hidden" name="star_rating" id="star_rating" required>
            <textarea name="content" required placeholder="Nội dung đánh giá"></textarea>
            <button class="normal" style="background: #088178;color: #fff;" type="submit">Gửi đánh giá</button>
        </form>
        @else
        <div class="form">
            <h3>Vui lòng đăng nhập để đánh giá</h3><br>
            <a href="{{ route('login') }}" class="normal">Đăng ký</a>
        </div>
        @endauth
    </section>
    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('star_rating');
        
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = star.getAttribute('data-value');
                ratingInput.value = rating;
                updateStars(rating);
            });
            
            star.addEventListener('mouseover', () => {
                updateStars(star.getAttribute('data-value'));
            });
    
            star.addEventListener('mouseout', () => {
                updateStars(ratingInput.value);
            });
        });
    
        function updateStars(rating) {
            stars.forEach(star => {
                star.classList.remove('selected');
                star.classList.add('fas', 'fa-star');
                if (star.getAttribute('data-value') <= rating) {
                    star.classList.add('selected');
                    star.classList.add('fas', 'fa-star');
                }
            });
        }
    </script>
</x-app-layout>