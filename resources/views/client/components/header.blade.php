<header class="container">
    <div class="row py-3 align-items-center">
        <!-- Social Icons -->
        <div class="col-lg-4 col-md-4 col-6 d-flex align-items-center">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
        </div>

        <!-- Logo -->
        <div class="col-lg-4 col-md-4 text-center">
            <div class="logo">
                <a href="#">
                    <h1 class="m-0">Marseille</h1>
                    <div class="tagline">XSTORE THEME</div>
                </a>
            </div>
        </div>

        <!-- Navigation Right -->
        <div class="col-lg-4 col-md-4 col-6">
            <div class="header-actions d-flex justify-content-end">
                <a href="{{ route('blogs') }}" class="me-3">Blogs</a>
                <a href="#" class="me-2">Contacts</a>
                <a href="#" class="me-3"><i class="fas fa-search"></i></a>
                @if (Auth::check())
                <a href={{ route('logout') }} class="me-3">Logout</a>
                @else
                <a href={{ route('login') }} class="me-3">Login</a>
                @endif

                <a href="#" class="me-3"><i class="far fa-heart"></i></a>
                <a href={{ route('cart.index') }} class="position-relative">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count">3</span>
                </a>
            </div>
        </div>
    </div>
</header>