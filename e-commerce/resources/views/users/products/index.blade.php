@extends('users.layouts.app')
@section('title','products')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{$sub_category->gender}}</h2>
                @forelse($products as $product)
                    <div class="product-item p-2 m-2">
                        <div class="pi-pic">
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <img id="img" style="height: 270px; width: auto" src="{{asset($product->image)}}" alt="">
                            @if($product->after_sale)
                            <div class="sale">Sale</div>
                            @endif
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><button id="add_cart"><i class="icon_bag_alt"></i></button></li>
                                <li class="quick-view">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#viewproduct" id="view">
                                        + View Product
                                    </button></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div id="product_name" class="catagory-name">{{$product->name}}</div>
                            <a href="#">
                                <h5>{{$product->category->name}}</h5>
                            </a>
                            <div class="product-price">
                                @if($product->after_sale)
                                    <label id="price_after_sale" class="d-none">{{ $product->after_sale }}</label>
                                    ${{$product->after_sale}}
                                    <span name="product_price">${{$product->original_price}}</span>

                                @else
                                    <label id="price_after_sale" class="d-none">{{ $product->original_price }}</label>

                                    ${{$product->original_price}}
                                @endif
                            </div>
                        </div>
                    </div>

                @empty
                    <p> there is no product yet</p>
                @endforelse

            </div>
            <!-- Modal -->
            <div class="modal fade" id="viewproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="content">

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

        $('#view').click((e)=>{
            e.preventDefault()
            $.ajax({
                type: "GET",
                url: `{{url('/product/show')}}/${id}}`,
                success:function (response){
                    $('#content').html(response)
                }

            } )
        });

        $('#add_cart').click(function (e) {
            e.preventDefault();

            var product_name=$('#prod_name').text();
            var product_id=$('#prod_id').val();

            var image=$('#img').attr('src');
            var product_price=$('#price_after_sale').text();   //label value
            // alert(image);

            $.ajax({
                method:"POST",
                url:"{{ route('cart.add') }}",
                data:{
                    'product_id' : product_id ,
                    'product_id' : product_id ,
                    'product_name' :product_name,
                    'product_qty' : 1,
                    'image' :image,
                    'product_price' :1

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
                            title: 'error',
                            text: response.msg,
                        })
                    }

                }
            })
        })
    </script>
@endsection

