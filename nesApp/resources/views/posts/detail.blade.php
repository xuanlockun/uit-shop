<x-app-layout>
    <section class="section-p1" style="text-align: center;">
        <h1>{{ $post->title }}</h1>
        {!! $post->content !!}
    </section>
</x-app-layout>