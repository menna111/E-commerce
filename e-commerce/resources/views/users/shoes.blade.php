@extends('users.layouts.app')
@section('title','shoes')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                @forelse($shoes as $product)
                    <div class="product-item p-2 m-2">
                        <div class="pi-pic">
                            <img style="height: 270px; width: auto" src="{{asset($product->image)}}" alt="">
                            @if($product->after_sale)
                                <div class="sale">Sale</div>
                            @endif
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{route('product.show',$product->id)}}">+ View Product</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$product->name}}</div>
                            <a href="#">
                                <h5>{{$product->category->name}}</h5>
                            </a>
                            <div class="product-price">
                                @if($product->after_sale)

                                    ${{$product->after_sale}}
                                    <span>${{$product->original_price}}</span>

                                @else
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


@endsection



