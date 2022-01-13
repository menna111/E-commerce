@extends('users.layouts.app')
@section('title','view product')
@section('content')
    <div class="bg-warning py-3 mb-4 shadow-sm border-top">
        <div class="container">
            <h6>collection / {{$product->category->name}} / {{$product->name}}</h6>
        </div>
    </div>
    <div class="container">
        <div class="card mb-3 shadow"  >
            <div class="row g-0">
                <div class="col-md-4 ">
                    <img id="img" src="{{asset($product->image)}}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{$product->name}}</h2>
                        <hr>
                        <label class="me-3">Original Price :<s> {{$product->original_price}}</s></label> &nbsp; &nbsp; &nbsp;
                        <label><b>Price on sale : $</b></label>
                        <label id="product_price" class="fw-bold"> {{$product->after_sale}}</label>

                        <p class="card-text">{{$product->description}}</p>

                        <hr>
                        @if($product->qty > 0)
                            <label class="badge bg-success">In Stock</label>
                        @else
                            <label class="badge bg-danger">Out Of Stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <label>Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button onclick="decrese();" class="input-group-text decrement-btn">-</button>
                                <input type="text" id="qty_val" name="quantity " value="1" class="form-control qty-input" />
                                <button onclick="increse({{$product->qty}});" class="input-group-text increment-btn">+</button>
                            </div>

                            </div>
                            <div style="margin-top: 35px;" class="col-md-9 ">
                                <form  class="d-inline">
                                    @csrf
                                    <input type="hidden" id="prod_id" value="{{$product->id}}">
                                    @if($product->qty > 0)
                                    <button type="submit" id="add_cart" class="btn btn-warning "> <a style="color: white;" href=""> <i class="fa fa-shopping-cart"></i> <b>add to cart</b></a> </button>
                                    @endif
                                </form>
                                <button  class="btn btn-success"> <a style="color: white;" href=""> <i class="fa fa-heart"></i> <b>add to favourite</b></a> </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        function increse(qty){
            var value=$('.qty-input').val();
            if(value < 10 && value< qty)
                value ++;
            $('.qty-input').val(value);
        }

        function decrese(){
            var dec_value=$('.qty-input').val();
            if(dec_value > 1 )
                dec_value -- ;
            $('.qty-input').val(dec_value);
        }


        $('#add_cart').click(function (e) {
            e.preventDefault();

            var product_name=$('h2').text();
            var product_id=$('#prod_id').val();
            var qty=$('#qty_val').val();
            var image=$('#img').attr('src');
            var product_price=$('#product_price').text();   //label value
                // alert(image);

            $.ajax({
                method:"POST",
                url:"{{ route('cart.add') }}",
                data:{
                    'product_id' : product_id ,
                    'product_name' :product_name,
                    'product_qty' : qty,
                    'product_image' :image,
                    'product_price' :product_price

                },
                success: function(response) {
                    if(response.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
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
        })


    </script>
@endsection
