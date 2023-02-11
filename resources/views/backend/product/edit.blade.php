@extends('backend.master')

@section('content')

<div class="container">

    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
            

                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                @endif
               

            <div class="card">
                <div class="card-header"> Add Product </div>
                <div class="card-body">
                    <form action="{{ url('/product/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">  
                        @csrf

                       
                        <div class="col-md-12 row flex flex-row justify-between">
                               
                            <div  class="form-group mr-4">
                                <label for="name">Category Name</label>
                                <select name="category_id" class="form-control" >
                                    <option selected disabled> ---Select A Category---</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{ $category->name}} </option>
                                @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group mr-4">
                                <label for="name">Brand Name</label>
                                <select  name="brand_id" class="form-control " >
                                    <option selected disabled>  --- Select A Brand --- </option>
                                @foreach ($brands as $brand)
                                <option  value="{{ $brand->id}}" {{$brand->id==$product->brand_id ? 'selected':''}}>{{ $brand->name}}</option>
                                @endforeach
                                    
                                </select>
                            </div>

                           

                            <div class="form-group ml-3">
                                <label for="name">Type Name (optional)</label>
                                <select name="type_id" class="form-control">
                                    <option selected disabled>--- Select A Type ---</option>
                                    @foreach ($types as $type)
                                        @if ($type->type_name)
                                            <option {{$type->id == $product->type_id ?'selected' :'' }} value="{{ $type->id}}">{{ $type->type_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="col-md-12 row flex flex-row justify-between flex-wrap">
                            <div class="form-group mr-4">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Enter product name">
                            </div>
    
                            <div class="form-group mr-4">
                                <label for="price">Product Price</label>
                                <input type="text" name="price" class="form-control" value="{{ $product->price}}" placeholder="Enter product price">
                            </div>
                                   
    
                            <div class="form-group mr-4">
                                <label >Discount % (Optional)</label>
                                <input type="text" name="discount_percentage" class="form-control" value="{{ $product->discount_percentage }}" placeholder="Enter discount percentage">
                            </div>   
    
                            <div class="form-group mr-4">
                                <label >Product Qty</label>
                                <input type="text" name="qty" class="form-control" value="{{ $product->qty}}" placeholder="Enter product quantity">
                            </div>
    
                            <div class="form-group mr-4">
                                <label >Color</label>
                                <input type="text" name="color" class="form-control" value="{{ $product->color}}" placeholder="Enter product color">
                            </div>
    
                            <div class="form-group mr-4">
                                <label >Size</label>
                                <input type="text" name="size" class="form-control" value="{{ $product->size}}" placeholder="Enter product size">
                            </div>
                            <div class="form-group mr-4">
                                <label >Tag</label>
                                <input type="text" name="tag" class="form-control" value="{{ $product->tag}}" placeholder="Enter product tag">
                            </div>
                        </div>

                        <div class="form-group">
                            <label >Short Description</label>
                            <textarea type="text" name="short_description" rows="5" class="form-control" value="{{ old('short_description')}}" placeholder="Enter product short description">{{$product->short_description}}</textarea>
                        </div>

                        <div class="form-group">
                            <label >Long Description</label>
                            <textarea class="form-control" name="long_description" id="long_description" placeholder="Enter long description" value="{{ old('long_description')}}">{{ $product->long_description}}</textarea>
                        </div>

                        

                        <div class="form-group">
                            <label >Product Photo</label>
                                <input type="file" name="image" class="form-control" >
                                <img class="border p-2 mb-1" src="/product/{{$product->image}}" alt="" width="70px" height="70px">
                        </div>

                        <div class="form-group">
                            <label >Gallery Photo</label>
                            <input type="file" name="images[]" multiple class="form-control" >
                            
                            <div class="row ml-1 mt-2">
                            @foreach ($product->productPhotos as $image)
                                <div class="d-flex flex-column mr-3">
                                    <img class="border p-2 mb-1" src="/public/images/{{$image->images}}" alt="" width="70px" height="70px">
                                    <a onclick="return confirm('Are you sure , you want to delete the image?')" class="btn btn-sm btn-danger" href="{{url('/delete/image/'.$image->id)}}"> Delete</a>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Publication Status</label>
                            <select name="status" class="form-control" >
                                <option disabled> ----Select A Status-----</option>
                                <option {{$product->status == 1? 'selected' : ''}} value="1">Active</option>
                                <option {{$product->status == 0? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Upload Product</button>
                    </form>
                </div>
            </div>
        </div>
    
       <div class="col-md-1"></div>
        </div>
    </div>

</div>






@endsection