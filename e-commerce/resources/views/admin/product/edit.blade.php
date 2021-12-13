@extends('admin.layouts.admin-dashboard')
@section('title','category')
<style>
    .form-select{
        width: 100%;
        height: auto;
        padding: 3px;
        color: #212529;
        background-color: #fff;
    }
</style>
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Add Product</h1>

        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="cate_id">
                            @forelse($categories as $category)
                                <option value="{{$category->id}}" @if($product->category->name == $category->name ) selected @endif>{{$category->name}}</option>
                            @empty
                                <p>there is no category</p>
                            @endforelse

                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for=""> Small Description</label>
                        <textarea name="small_description" rows="3" class="form-control">{{$product->small_description}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{$product->description}}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Original Price</label>
                        <input type="number" name="original_price" class="form-control" value="{{$product->original_price}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>selling Price</label>
                        <input type="number" name="selling_price" class="form-control" value="{{$product->selling_price}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tax</label>
                        <input type="number" name="tax" class="form-control" value="{{$product->tax}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Quantity</label>
                        <input type="number" name="qty" class="form-control" value="{{$product->qty}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox"  name="status" {{$product->status}} == 1 ? 'checked :'' >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox"  name="popular" {{$product->popular}} == 1 ? 'checked' :'' >
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{$product->meta_title}}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta keyword</label>
                        <textarea name="meta_keywords" rows="3" class="form-control" value="">{{$product->meta_keywords}}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta description</label>
                        <textarea name="meta_description" rows="3" class="form-control" >{{$product->meta_description}}</textarea>
                    </div>
                    @if($product->image)
                        <img src="{{asset($product->image)}}">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" >
                    </div>

                    <div class="col-md-12 m-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>


            </form>
        </div>
    </div>

@endsection
