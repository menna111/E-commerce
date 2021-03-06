
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
            <form id="add" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="cate_id">
                            <option value="">Select a Category</option>
                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                            <p>there is no category</p>
                            @endforelse

                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="sub_category_id">
                            <option value="">Product for ?</option>
                            @foreach($sub_category as $item)
                            <option value="{{$item->id}}" >{{$item->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Original Price</label>
                        <input type="number" name="original_price" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Price after sale</label>
                        <input type="number" name="after_sale" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tax</label>
                        <input type="number" name="tax" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Quantity</label>
                        <input type="number" name="qty" class="form-control">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox"  name="trending">
                    </div>

                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" >
                    </div>

                    <div class="col-md-12 m-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </div>
                @csrf

            </form>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add').submit(function (e){
            e.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                method:"POST",
                url:"{{ route('product.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    if(response.status == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: response.msg,
                        })
                        window.location.reload();
                    }else{
                        console.log(response.msg);
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
