@extends('users.layouts.app')
@section('title','clothes')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                @forelse($clothes as $product)
                    <div class="product-item p-2 m-2">
                        <div class="pi-pic">
                            <img id="img" style="height: 270px; width: auto" src="{{asset($product->image)}}" alt="">
                            @if($product->after_sale)
                                <div class="sale">Sale</div>
                            @endif
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><button onclick="add({{$product->id}})" class="btn"><i class="icon_bag_alt"></i></button></li>
                                <li>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#viewproduct"  onclick="view({{$product->id}})">
                                    + View Product
                                </button>
                                </li>
                            </ul>
                        </div>

                        <input id="qty" type="hidden" value=1>
                        <div class="pi-text">
                            <div id="prod_name" class="catagory-name">{{$product->name}}</div>
                            <a href="#">
                                <h5>{{$product->category->name}}</h5>
                            </a>
                            <div class="product-price">
                                @if($product->after_sale)
                                    <label id="price_after_sale" class="d-none">{{ $product->after_sale }}</label>
                                    <label id="product_price">${{$product->after_sale}} </label>
                                    <span>${{$product->original_price}}</span>

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
        </div>






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




@endsection


@section('script')

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });


        function view(id){
            $.ajax({
                type: "GET",
                url: `{{url('/product/show')}}/${id}`,
                success:function (response){
                    $('#content').html(response)
                }

            } )
        }

        function add(id){
            var product_name=$('#prod_name').text();
            var product_id=$('#prod_id').val();
            var qty=$('#qty').val();
            var image=$('#img').attr('src');
            var product_price=$('#price_after_sale').text();   //label value

            $.ajax({
                method:"POST",
                url:"{{ route('cart.add') }}",
                data:{
                    'product_id' : id ,
                    'product_name' :product_name,
                    'product_qty' : qty,
                    'image' :image,
                    'product_price' :product_price

                },
                success: function(response) {
                    console.log(response)
                    if(response.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: response.msg,
                        })
                        window.location.reload()
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
    </script>
@endsection
