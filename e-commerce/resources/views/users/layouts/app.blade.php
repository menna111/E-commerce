@include('partials.header')

<body>


<!-- Header Section Begin -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    hello.colorlib@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>

            @guest
            <div class="ht-right">
                <a href="{{ route('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                <div class="lan-selector">
                    {{--                    localization--}}
                    <ul class="">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
            @else
            <div class="ht-right">
                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                    @csrf
                </form>

                            <a href="{{route('logout')}}" type="button" class="login-panel" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-user" aria-hidden="true"></i>Logout</a>


                <div class="lan-selector">
                    {{--                    localization--}}


                    <ul style="list-style-type: none;">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li >
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>

            @endguest
        </div>
    </div>

    </div>
 @include('partials.nav')

    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <input type="text" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="heart-icon">
                            <a href="#">
                                <i class="icon_heart_alt"></i>
                                <span>1</span>
                            </a>
                        </li>
                        <li class="cart-icon">
                            @php
                                $products_num=\App\Models\Cart::where('user_id',\Illuminate\Support\Facades\Auth::id())->get()->count();

                            @endphp
                            <a href="{{route('cart')}}">
                                <i class="fa fa-shopping-cart"></i>

                                    @if ($products_num >0)
                                    <span> {{$products_num}}</span>
                                @endif

                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    @php
                                        $cart_products=\App\Models\Cart::where('user_id',\Illuminate\Support\Facades\Auth::id())->take(2)->get();


                                    @endphp
                                    <table>
                                        <tbody>
                                        @forelse($cart_products as $prod)
                                        <tr>
                                            <td class="si-pic"><img style="height: 50px; width: auto" src="{{asset($prod->image)}}" alt=""></td>
                                            <td class="si-text">
                                                <div class="product-selected">
                                                    <p> $ {{$prod->product_price}}</p>
                                                    <h6>{{$prod->product_name}}</h6>
                                                </div>
                                            </td>
                                            <td class="si-close">
                                                <i class="ti-close"></i>
                                            </td>
                                        </tr>
                                        @empty
                                            <p>you didnot add any product yet</p>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $total= 0;
                                        $cart=\App\Models\Cart::all('total');
                                         foreach ($cart as $item){
                                             $total += $item->total;
                                         }
                                    @endphp
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5>${{$total}}</h5>
                                </div>
                                <div class="select-button">
                                    <a href="{{route('cart')}}" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="{{route('checkout')}}" class="primary-btn checkout-btn">CHECK OUT</a>
                                </div>
                            </div>
                        </li>
{{--                        <li class="cart-price">$150.00</li>--}}
                    </ul>
                </div>
            </div>
        </div>
</header>
<!-- Header End -->

@yield('content')




@include('partials.footer')
@yield('script')
</body>

</html>
