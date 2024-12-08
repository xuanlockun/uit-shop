<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
<div id="nescss">
    <div class="container">
    <p>hi</p>
    @foreach ( $product as $item )
        <p>{{ $item }}</p>
    @endforeach
</div>
</div>
</x-guest-layout>