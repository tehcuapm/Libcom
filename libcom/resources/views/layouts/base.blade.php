<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="{{ asset('styles/header.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/global.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous">
    </script>
    @stack('head')
</head>

<body>
<header>

    <div id="header-top">

        <h2 id="header-title">ANIMALSCOM</h2>

        <div id="header-login">
            <div id="login-sect">
                @auth
                    <a href="{{ route('logout') }}">Logout</a>
                    <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}">
                        <p id="login-curr">{{ Auth::user()->name }}</p>
                    </a>

                @endauth
                @guest
                    <img src="{{ asset('assets/login.png') }}" class="icon">
                    <a href="{{ route('login.form') }}" id="login-link">Login</a>
                @endguest
            </div>

        </div>
    </div>
    <div id="header-down">
        <nav id="header-menu">
            <ul id="menu-list">
                <li><a href="{{ route('home') }}" class="hover-link">HOME</a></li>
                <li><a href="{{ route('article.index') }}" class="hover-link">PRODUCTS</a></li>
                <li><a href="" class="hover-link">ABOUT</a></li>
                <li><a href="" class="hover-link">CONTACT</a></li>
                <li><a href="" class="hover-link">HELP</a></li>
                @role('admin')
                <li><a href="{{ route('admin') }}" class="hover-link">Admin</a></li>
                @endrole
            </ul>
        </nav>
        <div id="header-shopping">

            <a href="{{ route('panier.show') }}">
                <img src="{{ asset('assets/shopping.png') }}" class="icon">
                <label>CART(<span id="panier-quantity">0</span>)</label>
            </a>

        </div>
    </div>
</header>
<div class="popup">
    <div class="popup-content">
        <div class="popup-header">
            We want your cookies...please for the craftman money
        </div>
        <div class="popup-body">
            <button id="activate-cookie">Activate</button>
            <button id="disable-cookie">Disable</button>
        </div>
    </div>
</div>

@yield('content')
<footer>
    <div id="reseaux">
        <h5>Retrouvez nous sur les réseaux !</h5>
        <a href="https://twitter.com/"><img class="logo_f" src="{{ asset('assets/twitter_logo.png') }}"
                                            alt="twitter logo"></a>
        <a href="https://www.facebook.com/"><img id="logo_face" class="logo_f"
                                                 src="{{ asset('assets/facebook_logo.png') }}" alt="facebook logo"></a>
    </div>
    <div id="contact">
        <h5>Nous contacter</h5>
        <p>turpin_l@etna-alternance.net</p>
        <p>pauche_m@etna-alternance.net</p>
    </div>
</footer>
</body>
<script src="/js/app.js"></script>
@stack("scripts")

</html>
