@extends('admin.layouts.admin-dashboard')
@section('title','category')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Edit Category</h1>

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
            <form id="edit_category" action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$category->slug}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control" >{{$category->description}}</textarea>
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox"  name="status"  {{$category->status == "1" ? 'checked' :''}} >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox"  name="popular"  {{$category->popular == "1" ? 'checked' :''}}>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{$category->meta_title}}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta keyword</label>
                        <textarea name="meta_keywords" rows="3" class="form-control" >{{$category->meta_keywords}}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Meta description</label>
                        <textarea name="meta_description" rows="3" class="form-control"  >{{$category->meta_description}}</textarea>
                    </div>
                    @if($category->image)
                        <img style="width: 100px;height: 100px" src="{{asset($category->image)}}" alt="cat">
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
@section('script')
    <script>
        $('#edit_category').submit(function (e) {
            e.preventDefault()
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: `{{ route('category.update', $id) }}`,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم بنجاح!',
                            text: response.msg,

                        })


                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: response.msg,
                        })
                    }
                }
            });
        })
    </script>
@endsection