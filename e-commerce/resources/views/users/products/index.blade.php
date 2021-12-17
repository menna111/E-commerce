@extends('users.layouts.app')
@section('title','products')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{$sub_category->gender}}</h2>
                @forelse($products as $product)
                    <div class="product-item p-5 m-5">
                        <div class="pi-pic">
                            <img style="height: 350px; width: auto" src="{{asset($product->image)}}" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
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



