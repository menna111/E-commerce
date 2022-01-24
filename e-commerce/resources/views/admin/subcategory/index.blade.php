@extends('admin.layouts.admin-dashboard')
@section('title','category')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1> sub Categories</h1>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
        </div>
        <div class="card-body ">
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#sub_category" id="Add_sub">
                Add Sub Category
            </button>
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
                @forelse($subcategories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->description}}</td>
                        <td>
                            <img style="height: 50px; width: 50px" src="{{asset($category->image)}}" alt="category">
                        </td>
                        <td>
                            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sub_category"  onclick="editsub({{$category->id}})">
                                Edit </a>
                            <a href="{{route('sub.delete',$category->id)}}" class="btn btn-danger">Delete</a>

                        </td>

                    </tr>
                @empty
                    <p>there is no category yet</p>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="sub_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        $('#Add_sub').click((e)=>{
            e.preventDefault()
            $.ajax({
                type: "GET",
                url: `{{route('sub.add')}}`,
                success:function (response){
                    $('#content').html(response)
                }

            } )
        });

        function editsub(id){
            $.ajax({
                type: "GET",
                url: `{{url('/sub_category/edit')}}/${id}`,
                success:function (response){
                    $('#content').html(response)
                }

            } )
        }
    </script>
@endsection
