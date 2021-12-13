@extends('admin.layouts.admin-dashboard')
@section('title','category')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Categories</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
        </div>
        <div class="card-body ">
            <a href="{{route('category.add')}}" class="btn btn-primary  m-3"   >Add Category </a>
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
                @forelse($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            <img style="height: 50px; width: 50px" src="{{asset($category->image)}}" alt="category">
                           </td>
                        <td>
                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger">Delete</a>

                        </td>

                    </tr>
                @empty
                        <p>there is no category yet</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('script')
   <script>
       function add_category(){
           $.ajax({
               type: "GET",
               url: `{{route('category.add')}}`,



           } )

       }
   </script>
@endsection
