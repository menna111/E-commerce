<div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>All departments</span>
                    <ul class="depart-hover">
                        <li class="active"><a href="#">Women’s Clothing</a></li>
                        <li><a href="c">Clothes</a></li>
                        <li><a href="#">bags</a></li>
                        <li><a href="#">Accessories/Shoes</a></li>

                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{route('home')}}">Home</a></li>

                    <li><a href="#">Collection</a>
                        <ul class="dropdown">
                            <li><a href="{{route('clothes')}}">clothes</a></li>
                            <li><a href="{{route('bags')}}">bags</a></li>
                            <li><a href="{{route('shoes')}}">shoes</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('contact')}}">Contact</a></li>
                    <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            <li><a href="./blog-details.html">Blog Details</a></li>
                            <li><a href="{{route('cart')}}">Shopping Cart</a></li>
                            <li><a href="{{route('checkout')}}">Checkout</a></li>
                            <li><a href="{{route('register')}}">Register</a></li>
                            <li><a href="{{route('login')}}">Login</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
