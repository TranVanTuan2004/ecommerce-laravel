<style>
    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa !important;
        color: black !important;
    }
</style>
<header class="container py-3">
    <div class="" style="display: grid; grid-template-columns: repeat(3, 1fr); gap:20px">
        <!-- Social + Nav -->
        <div class="d-flex align-items-center gap-1 flex-wrap">
            <div class="social-icons d-flex gap-1">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('blogs') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contacts</a>
                </li>
            </ul>
        </div>

        <!-- Logo -->
        <div class="text-center">
            <div class="logo">
                <a href="#">
                    <h1 class="m-0">Marseille</h1>
                    <div class="tagline">XSTORE THEME</div>
                </a>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex align-items-center gap-3" style="justify-self: end;">
            <div class="header-actions d-flex justify-content-end gap-2">

                <a href="#" class="me-3"><i class="fas fa-search"></i></a>
                <a href={{ route('favorite.index') }} class="me-3 position-relative">
                    <i class="far fa-heart"></i>
                    <span class="cart-count">{{ $wishlistCount }}</span>
                </a>
                <a href={{ route('cart.index') }} class="position-relative">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="cart-count">{{ $count }}</span>
                </a>
                <div class="ms-4">
                    <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                        <i class="fa-solid fa-user" style="font-size: 20px"></i>
                    </div>
                    <div class="dropdown-menu dropdown-menu-left shadow-sm border-0 rounded-lg p-2"
                        style="width: 220px;">

                        <a class="dropdown-item d-flex align-items-center justify-content-start py-2"
                            href={{ route('auth.profile') }}>
                            <i class="fa fa-user-circle mr-2 text-primary"></i> <span
                                class="d-block ms-3">Profile</span>
                        </a>

                        <a class="dropdown-item d-flex align-items-center justify-content-start py-2"
                            href="{{ route('orders.index') }}">
                            <i class="fa fa-history mr-2 text-info"></i> <span class="d-block ms-3">Orders
                                History</span>
                        </a>

                        <div class="dropdown-divider my-1"></div>

                        @if (Auth::check())
                            <a class="dropdown-item d-flex align-items-center justify-content-start py-2 text-danger"
                                href="{{ route('logout') }}">
                                <i class="fa fa-sign-out-alt mr-2"></i> <span class="d-block ms-3">Logout</span>
                            </a>
                        @else
                            <a class="dropdown-item d-flex align-items-center justify-content-start py-2 text-success"
                                href="{{ route('login') }}">
                                <i class="fa fa-sign-in-alt mr-2"></i> <span class="d-block ms-3">Login</span>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
