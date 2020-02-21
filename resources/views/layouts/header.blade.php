<header>
    <!-- Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <!-- Header Top left Start -->
                <div class="col-lg-4 col-md-12 d-center">
                    <div class="header-top-left">
                        <img src="/img/icon/call.png" alt="">Зателефонуйте : +11 222 3333
                    </div>
                </div>
                <!-- Header Top left End -->
                <!-- Search Box Start -->
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <div class="search-box-view">
                        <form action="#">
                            <input type="text" class="email" placeholder="Search Your Product" name="product">
                            <button type="submit" class="submit"></button>
                        </form>
                    </div>
                </div>
                <!-- Search Box End -->
                <!-- Header Top Right Start -->
                <div class="col-lg-4 col-md-12">
                    <div class="header-top-right">
                        <ul class="header-list-menu f-right">
                            <!-- Language Start -->
                            <li><a href="#">Language: English <i class="fa fa-angle-down"></i></a>
                                <ul class="ht-dropdown">
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">Bengali</a></li>
                                    <li><a href="#">Russian</a></li>
                                </ul>
                            </li>
                            <!-- Language End -->
                            <!-- Currency Start -->
                            <li><a href="#">Currency: USD <i class="fa fa-angle-down"></i></a>
                                <ul class="ht-dropdown">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">GBP</a></li>
                                    <li><a href="#">EUR</a></li>
                                </ul>
                            </li>
                            <!-- Currency End -->
                        </ul>
                        <!-- Header-list-menu End -->
                    </div>
                </div>
                <!-- Header Top Right End -->
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Top End -->
    <!-- Header Bottom Start -->
    <div class="header-bottom header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-2 col-sm-5 col-5">
                    <div class="logo">
                        <a href="{{url('/')}}"><img src="/img/logo/logo.png" alt="logo-image"></a>
                    </div>
                </div>
                <!-- Primary Vertical-Menu End -->
                <!-- Search Box Start -->
                <div class="col-xl-7 col-lg-7 d-none d-lg-block">
                    <div class="middle-menu pull-right">
                        <nav>
                            <ul class="middle-menu-list">
                                <li><a href="{{url('/')}}">Головна<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown home-dropdown">
                                        <li><a href="{{url('/')}}">Головна 1 версія</a></li>
                                        <li><a href="{{url('/index-2')}}">Головна 2 версія</a></li>
                                        <li><a href="{{url('/index-3')}}">Home Box Layout</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="{{ url('about') }}">Про нас</a></li>
                                <li><a href="{{ url('shop') }}">Магазин<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown dropdown-style-two">
                                        <li><a href="{{ url('shop') }}">Магазин</a>
                                            <!-- Start Two Step -->
                                            <ul class="ht-dropdown dropdown-style-two sub-menu">
                                                <li><a href="{{ url('shop') }}">Імя категорії</a>
                                                    <!-- Start Three Step -->
                                                    <ul class="ht-dropdown dropdown-style-two sub-menu">
                                                        <li><a href="{{ url('shop') }}">Імя категорії</a></li>
                                                        <li><a href="{{ url('shop') }}">Імя категорії</a></li>
                                                        <li><a href="{{ url('shop') }}">Імя категорії</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ url('shop') }}">Імя категорії</a></li>
                                                <li><a href="{{ url('shop') }}">Імя категорії</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ url('compare') }}">Порівняння товару</a></li>
                                        <li><a href="{{ url('checkout') }}">Сторінка оформлення замовлення</a></li>
                                        <li><a href="{{ url('wishlist') }}">Сторінка побажань</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="{{ url('blog') }}">Блог<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown dropdown-style-two">
                                        <li><a href="{{ url('blog') }}">Блог</a></li>
                                        <li><a href="{{ url('blog-details') }}">Перегляд блоу</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="#">Стор<i class="fa fa-angle-down"></i></a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul class="ht-dropdown dropdown-style-two">
                                        <li><a href="{{ url('login') }}">Авторизація</a></li>
                                        <li><a href="{{ url('register') }}">Реєстрація</a></li>
                                        <li><a href="{{ url('404') }}">404 Page</a></li>
                                        <li><a href="{{ url('forgot-password') }}">Відновлення паролю</a></li>
                                        <li><a href="{{ url('account') }}">Особистий кабінет</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="{{ url('contact') }}">Контакти</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Search Box End -->
                <!-- Cartt Box Start -->
                <div class="col-lg-2 col-sm-7 col-7">
                    <div class="cart-box text-right">

                        <ul>
                            <li><a href="{{url('compare')}}"><i class="fa fa-cog"></i></a>
                                <ul class="ht-dropdown">
                                    @guest
                                        <li>
                                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li><a href="{{url('account')}}">Account</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </li>
                                    @endguest
                                </ul>
                            </li>
                            <li><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>


                            <basket-component></basket-component>

                        </ul>
                    </div>
                </div>
                <!-- Cartt Box End -->
                <div class="col-sm-12 d-lg-none">
                    <div class="mobile-menu">
                        <nav>
                            <ul>
                                <li><a href="index.html">home</a>
                                    <!-- Home Version Dropdown Start -->
                                    <ul>
                                        <li><a href="index.html">Home Version One</a></li>
                                        <li><a href="index-2.html">Home Version Two</a></li>
                                        <li><a href="index-3.html">Home Box Layout</a></li>
                                    </ul>
                                    <!-- Home Version Dropdown End -->
                                </li>
                                <li><a href="shop.html">shop</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="product.html">Shop</a>
                                            <ul>
                                                <li><a href="shop.html">Product Category Name</a>
                                                    <!-- Start Three Step -->
                                                    <ul>
                                                        <li><a href="shop.html">Product Category Name</a></li>
                                                        <li><a href="shop.html">Product Category Name</a></li>
                                                        <li><a href="shop.html">Product Category Name</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="shop.html">Product Category Name</a></li>
                                                <li><a href="shop.html">Product Category Name</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="product.html">product details Page</a></li>
                                        <li><a href="compare.html">Compare Page</a></li>
                                        <li><a href="cart.html">Cart Page</a></li>
                                        <li><a href="checkout.html">Checkout Page</a></li>
                                        <li><a href="wishlist.html">Wishlist Page</a></li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="blog.html">Blog</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="blog-details.html">Blog Details Page</a></li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="#">pages</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        <li><a href="login.html">login Page</a></li>
                                        <li><a href="register.html">Register Page</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                    </ul>
                                    <!-- Mobile Menu Dropdown End -->
                                </li>
                                <li><a href="about.html">about us</a></li>
                                <li><a href="contact.html">contact us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Mobile Menu  End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Bottom End -->
</header>
