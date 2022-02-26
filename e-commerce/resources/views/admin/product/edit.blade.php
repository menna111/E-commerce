
    <div class="card">
        <div class="card-header">
            <h1>Edit Product</h1>

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
            <form id="edit" enctype="multipart/form-data">
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
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="sub_category_id">
                            @foreach($sub_category as $item)
                            <option value="{{$item->id}}" @if( $product->subcategory->name == $item->name) selected @endif >{{$item->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
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
                        <label>Price after sale</label>
                        <input type="number" name="after_sale" class="form-control" value="{{$product->after_sale}}">
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
                        <label for="">Trending</label>
                        <input type="checkbox"  name="trending" {{$product->trending}} == 1  ? checked : '' >
                    </div>

                    @if($product->image)
                        <img style="width: 200px;height: 200px" src="{{asset($product->image)}}">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" >
                    </div>

                    <div class="col-md-12 m-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>


                </div>


            </form>
        </div>
    </div>

    <script>
        $('#edit').submit(function (e) {
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
                            title: success',
                            text: response.msg,

                        })
                        window.location.reload()

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'error',
                            text: response.msg,
                        })
                    }
                }
            });
        })
    </script>
