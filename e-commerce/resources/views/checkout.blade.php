@extends('users.layouts.app')
@section('title','checkout')
@section('content')

   <!-- Breadcrumb Section Begin -->
   <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>

                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad ">
        <div class="container">
            <form id="checkout"  class="checkout-form" action="{{route('placeorder')}}">

                <div class="row">
                    <div class="col-lg-6">
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">First Name<span>*</span></label>
                                <input type="text" id="fir" name="fname" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="last">Last Name<span>*</span></label>
                                <input type="text" id="last" name="lname" required>
                            </div>
{{--                            <div class="col-lg-12">--}}
{{--                                <label for="cun-name">Company Name</label>--}}
{{--                                <input type="text" id="cun-name">--}}
{{--                            </div>--}}
                            <div class="col-lg-12">
                                <label for="cun">Country<span>*</span></label>
                                <input type="text" id="cun" name="country" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first" name="streetadress1" required>
                                <input type="text" name="streetadress2">
                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Postcode / ZIP (optional)</label>
                                <input type="text" id="zip" name="postcode" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="town">Town / City<span>*</span></label>
                                <input type="text" id="town" name="town" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email Address<span>*</span></label>
                                <input type="text" id="email" name="email" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone" name="phone" required>
                            </div>
                            <div class="col-lg-12">
                                <div class="create-item">
                                    <label for="acc-create">
                                        Create an account?
                                        <input type="checkbox" id="acc-create">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 border-left">

                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <table class="table">
                                    <thead>
                                    <th>Product</th>
                                    <th>quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>


                                    </thead>
                                    <tbody>
                                    @php $total=0; @endphp
                                    @forelse($products as $product)
                                        <tr>
                                             <td class="fw-normal">{{$product->product_name}} </td>
                                             <td class="fw-normal">{{$product->product_qty}} </td>
                                             <td class="fw-normal">{{$product->product_price}} </td>
                                            <td class="fw-normal">{{$product->total}} </td>


                                            <input hidden name="product_id" value="{{$product->id}}">
                                            <input hidden name="product_name" value="{{$product->product_name}}">
                                            <input hidden name="qty" value="{{$product->product_qty}}">
                                            <input hidden name="price" value="{{$product->product_price}}">

                                        </tr>
                                        @php $total +=$product->total  @endphp

                                    @empty
                                        <td class="fw-normal"><p style="color: red" ;>you have no thing to checkout</p></td>
                                    @endforelse
                                    </tbody>
                                </table>


                                   <div class="pc-item m-4">
                                       <h3> Big Total=${{$total}}</h3>
                                       <input type="hidden" value="{{$total}}" name="total">
                                   </div>
                                </div>
                                <div class="order-btn m-4" style="text-align: center;">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>

{{--                            //paypal button--}}
                            <div id="smart-button-container">
                                <div style="text-align: center;">
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
{{--                                  // End of paypal button--}}


                        </div>
                    </div>
                </div>
            </form>
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
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        {{--$('#checkout').submit(function (e){--}}
        {{--    e.preventDefault();--}}

        {{--    var formData = new FormData(this);--}}
        {{--    $.ajax({--}}
        {{--        method:"POST",--}}
        {{--        url:"{{ route('placeorder') }}",--}}
        {{--        data: formData,--}}
        {{--        contentType: false,--}}
        {{--        processData: false,--}}
        {{--        success: function(response) {--}}
        {{--            if(response.status == true){--}}
        {{--                Swal.fire({--}}
        {{--                    icon: 'success',--}}
        {{--                    title: 'success',--}}
        {{--                    text: response.msg,--}}
        {{--                })--}}
        {{--                window.location.reload()--}}

        {{--            }else{--}}
        {{--                console.log(response.msg);--}}
        {{--                Swal.fire({--}}
        {{--                    icon: 'error',--}}
        {{--                    title: 'error',--}}
        {{--                    text: response.msg,--}}
        {{--                })--}}
        {{--            }--}}

        {{--        }--}}
        {{--    })--}}
        {{--})--}}


    </script>


{{--    //////// paypal///////--}}
    <script src="https://www.paypal.com/sdk/js?client-id=AeCMUl56NEzuimpX8-MIu6VAUvsALrR7lk0tuMA5JBq8Er4aZYpEpkqTu4gsUwE0kanCXran6G6S840R" data-sdk-integration-source="button-factory"></script>
    <script>
        function initPayPalButton() {
            paypal.Buttons({
                style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'paypal',

                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        // Show a success message within this page, e.g.
                        const element = document.getElementById('paypal-button-container');
                        element.innerHTML = '';
                        element.innerHTML = '<h3>Thank you for your payment!</h3>';

                        // Or go to another URL:  actions.redirect('thank_you.html');

                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render('#paypal-button-container');
        }
        initPayPalButton();
    </script>

{{--        //////// End of paypal///////--}}


@endsection
