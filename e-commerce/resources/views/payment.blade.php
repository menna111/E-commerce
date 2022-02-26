@extends('users.layouts.app')
@section('title','checkout')
@section('content')

    <div class="container">
        <div class="row m-5">
            <div class="col-md-12">
                <h2 style="color: mediumvioletred" class="mb-3">your order</h2>
                <table class="table">
                    <tr>
                        <thead>
                        <th>First Name</th>
                        <th>Last name</th>
                        <th>Country</th>
                        <th>Streetadress1</th>
                        <th>Streetadress2</th>
                        <th>Town</th>
                        <th>Post Code</th>
                        <th>Phone</th>
                        <th>Total</th>
                        </thead>
                    </tr>
                    <tr>
                        <tbody>
                        <td>{{$order->fname}}</td>
                        <td>{{$order->lname}}</td>
                        <td>{{$order->country}}</td>
                        <td>{{$order->streetadress1}}</td>
                        <td>{{$order->streetadress2}}</td>
                        <td>{{$order->town}}</td>
                        <td>{{$order->postcode}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->total}}</td>

                        </tbody>
                    </tr>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 " >
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

    @endsection

@section('script')
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
