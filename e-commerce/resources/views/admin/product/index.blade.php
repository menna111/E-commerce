@extends('admin.layouts.admin-dashboard')
@section('title','products')
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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#product" id="addproduct">
                Add Product
            </button>
            <table class="table border">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th> Price</th>
                    <th>Image</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->after_sale}}</td>

                        <td>
                            <img style="height: 50px; width: 50px" src="{{asset($product->image)}}" alt="Product">
                        </td>
                        <td>
                            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#product"  onclick="editproduct({{$product->id}})">
                                Edit </a>
                            <a href="{{route('product.delete',$product->id)}}" class="btn btn-danger">Delete</a>

                        </td>

                    </tr>
                @empty
                    <p>there is no Product yet</p>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addproduct').click((e)=>{
            e.preventDefault()
            $.ajax({
                type: "GET",
                url: `{{route('product.add')}}`,
                success:function (response){
                    $('#content').html(response)
                }

            } )
        });

        function editproduct(id){
            $.ajax({
                type: "GET",
                url: `{{url('/product/edit')}}/$id`,
                success:function (response){
                    $('#content').html(response)
                }

            } )
        }
    </script>
@endsection
