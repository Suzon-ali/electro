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
                    <form action="{{ url('/product/store')}}" method="POST" enctype="multipart/form-data">  
                        @csrf

                       
                        <div class="col-md-12 row flex flex-row justify-between">
                               
                            <div  class="form-group mr-4">
                                <label for="name">Category Name</label>
                                <select name="category_id" class="form-control" >
                                    <option selected disabled> ---Select A Category---</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id}}">{{ $category->name}}</option>
                                @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group mr-4">
                                <label for="name">Brand Name</label>
                                <select  name="brand_id" class="form-control " >
                                    <option selected disabled>  --- Select A Brand --- </option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id}}">{{ $brand->name}}</option>
                                @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group ml-3">
                                <label for="name">Type Name (optional)</label>
                                <select  name="type_id" class="form-control" >
                                    <option selected disabled >  --- Select A Type --- </option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id}}">{{ $type->type_name}}</option>
                                @endforeach
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 row flex flex-row justify-between flex-wrap">
                            <div class="form-group mr-4">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name')}}" placeholder="Enter product name">
                            </div>
    
                            <div class="form-group mr-4">
                                <label for="price">Product Price</label>
                                <input type="text" name="price" class="form-control" value="{{ old('price')}}" placeholder="Enter product price">
                            </div>
                                   
    
                            <div class="form-group mr-4">
                                <label >Discount % (Optional)</label>
                                <input type="text" name="discount_percentage" class="form-control" value="{{ old('discount_percentage')}}" placeholder="Enter discount percentage">
                            </div>   
    
                            <div class="form-group mr-4">
                                <label >Product Qty</label>
                                <input type="text" name="qty" class="form-control" value="{{ old('qty')}}" placeholder="Enter product quantity">
                            </div>
    
                            <div class="form-group mr-4">
                                <label >Color</label>
                                <input type="text" name="color" class="form-control" value="{{ old('color')}}" placeholder="Enter product color">
                            </div>
    
                            <div class="form-group mr-4">
                                <label >Size</label>
                                <input type="text" name="size" class="form-control" value="{{ old('size')}}" placeholder="Enter product size">
                            </div>
                            <div class="form-group mr-4">
                                <label >Tag</label>
                                <input type="text" name="tag" class="form-control" value="{{ old('tag')}}" placeholder="Enter product tag">
                            </div>
                        </div>

                        <div class="form-group">
                            <label >Short Description</label>
                            <textarea type="text" name="short_description" rows="5" class="form-control" value="{{ old('short_description')}}" placeholder="Enter product short description"></textarea>
                        </div>

                        <div class="form-group">
                            <label >Long Description</label>
                            <textarea class="form-control" name="long_description" id="long_description" placeholder="Enter long description" value="{{ old('long_description')}}"></textarea>
                        </div>

                        <div class="form-group">
                            <label >Product Photo</label>
                            <input type="file" name="image" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label >Gallery Photo</label>
                            <input type="file" name="images[]" multiple class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="name">Publication Status</label>
                            <select name="status" class="form-control" >
                                <option selected disabled> ----Select A Status-----</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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