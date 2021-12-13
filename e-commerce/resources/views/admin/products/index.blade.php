@extends('admin.layouts.admin-dashboard')
@section('title','category')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Products</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
        </div>
        <div class="card-body ">
            <a href="{{route('product.add')}}" class="btn btn-primary  m-3"   >Add Product </a>
            <table class="table border">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>
                            <img style="height: 50px; width: 50px" src="{{asset($product->image)}}" alt="Product">
                        </td>
                        <td>
                            <a href="{{route('category.edit',$product->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('category.delete',$product->id)}}" class="btn btn-danger">Delete</a>

                        </td>

                    </tr>
                @empty
                    <p>there is no Product yet</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('script')
    <script>
        {{--function add_category(){--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: `{{route('category.add')}}`,--}}



        {{--    } )--}}

        {{--}--}}
    </script>
@endsection
