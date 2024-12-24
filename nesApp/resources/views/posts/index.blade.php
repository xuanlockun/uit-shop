<x-app-layout>
    <h1>Danh sách bài viết</h1>
    <section id="product1" class="section-p1">\
        <div class="pro-container">
            @foreach ($posts as $post)
                <div class="pro">
                    <a href="{{ route('blog.detail', $post->id) }}">
                        <img src="{{ $post->image }}" alt="">
                        <div class="des">
                            <span>{{ $post->title }}</span>
                            <h5>{{ $post->title }}</h5>
                            <h4>{{ $post->short }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>