@extends('users.layouts.app')
@section('title','cart')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{route('shop')}}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad shadow">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $total=0; @endphp
                            @forelse($products as $prod)
                                <tr>
                                    <td class="cart-pic first-row"><img style="height: 100px;width: auto" src="{{asset($prod->image)}}" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5>{{$prod->product_name}}</h5>
                                    </td>
                                    <td class="p-price first-row">$ {{$prod->product_price}}</td>
{{--                                    <td class="qua-col first-row">--}}
{{--                                        <div class="quantity">--}}
{{--                                            <div class="pro-qty">--}}
{{--                                                <input hidden id="product_id" type="text" value="{{$prod->id}}">--}}

{{--                                                <input id="qty" type="text" value="{{$prod->product_qty}}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    <td class="qua-col first-row">
                                    <div class="input-group text-center mb-3">
                                        <input type="hidden" value="{{$prod->product_price}}" class="p_price">

                                        <button onclick="decrese({{ $prod->id }});" class="input-group-text decrement-btn">-</button>
                                        <input type="text" id="qty" name="quantity " value="{{$prod->product_qty}}" class="form-control qty-input_{{$prod->id}}" />

                                        <button onclick="increse({{$prod->product->qty}}, {{$prod->id}});"  class="input-group-text increment-btn">+</button>
                                    </div>
                                    </td>
                                    <td class="total-price first-row">$60.00</td>
                                    <td class="close-td first-row"><i onclick="delete_product({{$prod->id}});" class="ti-close"></i></td>
                                </tr>
                                @php $total +=$prod->product->after_sale * $prod->product_qty    @endphp
                            @empty
                                <td>
                            <p style="color: red;">you havenot any product yet</p>
                                </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">

                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="#" class="primary-btn up-cart">Update cart</a>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>${{$total}}</span></li>
                                    <li class="cart-total">Total <span>${{$total}}</span></li>
                                </ul>
                                <a href="{{route('checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->

@endsection
@section('script')
    <script>



        function increse(qty, id){
            var p_price=$('.p_price').val();
            var value=$('.qty-input_' + id).val();   // input value
            if(value < 10 && value< qty)
                value ++;
            $('.qty-input_' + id).val(value);


            data= {
                'id': id,
                'p_qty': value,
                'p_price' : p_price,
            }
            $.ajax({
                method: 'POST',
                url:"{{route('cart.update')}}",
                data:data,
                success: function(response) {
                    console.log(response)
                    if(response.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'تم بنجاح',
                            text: response.msg,
                        })
                    }else{
                        // alert(response.msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: response.msg,
                        })
                    }

                }

            })

        }

        function decrese(id){
            var dec_value=$('.qty-input_' + id).val();
            if(dec_value > 1 )
                dec_value -- ;
            $('.qty-input_' + id).val(dec_value);


            data= {
                'id': id,
                'p_qty': dec_value,
            }
            $.ajax({
                method: 'POST',
                url:"{{route('cart.update')}}",
                data:data,
                success: function(response) {
                    if(response.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'تم بنجاح',
                            text: response.msg,
                        })
                    }else{
                        // alert(response.msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'error',
                            text: response.msg,
                        })
                    }

                }

            })
        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });



        function delete_product(id){
            $.ajax({
                type:'GET',
                url:`{{url('/cart/delete')}}/${id}`,
                success: function(response) {
                    if(response.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'تم بنجاح',
                            text: response.msg,
                        })
                    }else{
                        // alert(response.msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'خطا',
                            text: response.msg,
                        })
                    }

                }
            })




        }

    </script>
@endsection
