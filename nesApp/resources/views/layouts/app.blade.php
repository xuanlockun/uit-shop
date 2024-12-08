<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Do an web chill' }}</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="{{ asset('style.css') }}"/>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>

<body>
    <div id="popup" class="popup">
        <span id="popup-message"></span>
        <span class="close" onclick="hidePopup()" style="cursor: pointer; margin-left: 10px;">&times;</span>
    </div>
    @include('chat')

<script>
    function showPopup(message) {
        const popup = document.getElementById('popup');
        const messageSpan = document.getElementById('popup-message');
        messageSpan.textContent = message;
        popup.classList.add('show');

        setTimeout(() => {
            hidePopup();
        }, 3000);
    }

    function hidePopup() {
        const popup = document.getElementById('popup');
        popup.classList.remove('show');
    }

    @if (session('success'))
        showPopup('{{ session('success') }}');
    @endif
</script>
    <section id="header">
        <a href="{{ route('home') }}" class="logo">uit</a>
        <div>
            <ul id="navbar">
                <li><a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                <li><a class="{{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">Shop</a></li>
                <li><a class="{{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a></li>
                <li><a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('home') }}">About</a></li>
                @if(Auth::check()) 
                    <li><a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Profile</a></li>
                @else
                    <li><a class="{{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
                @endif
                <li><a class="{{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart.index') }}"><i class="fas fa-shopping-bag"></i></a></li>
            </ul>
        </div>
    </section>

    <main>
        {{ $slot }} 
    </main>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4> Đăng ký tài khoản ngay </h4>
            <p>Đăng ký tài khoản để được giảm giá và <span>khuyến mãi </span>.</p>
        </div>
        <div class="form">
            <a href="{{ route('login') }}" class="normal">Đăng ký</a>
        </div>
    </section>


    <footer class="section-p1">
        <div class="col">
            {{-- <img class="logo" src="img/logo.png" alt=""> --}}
            <a href="#" class="logo">UIT</a>
            <h4>Contact</h4>
            <p><strong>Address:</strong> UIT - Trường ĐH CNTT</p>
            <p><strong>Phone:</strong> 012345678989</p>
            <p><strong>Hours:</strong> 8:00 - 18:00, Mon - Fri</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" alt="">
        </div>

        {{-- <div class="copyright">
            <p>footer test</p>
        </div> --}}
    </footer>


    <script src="{{ asset('script.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>