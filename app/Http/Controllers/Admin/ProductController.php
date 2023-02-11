<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
       
        $categories = Category::orderby('id', 'desc')->where('status', 1)->get();
        $brands = Brand::with('category')->orderby('created_at', 'desc')->get();
        $types = Type::get();
        return view('backend.product.add', compact('categories' , 'brands', 'types'));
    }

    public function storeProduct(Request $request)
    {
        $this->validate($request,[
            'category_id'               =>'required|integer',
            'brand_id'                  =>'required',
            'name'                      =>'required|string',
            'price'                     =>'required',
            'qty'                       =>'required|integer',
            'short_description'         =>'required|string',
            'long_description'          =>'required|string',
            'color'                     =>'required',
            'size'                      =>'required',
            'status'                    =>'required|integer',
            'image'                     =>'required',
            'images'                    =>'required',
        ]);
    
        if($request->file('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image = $request->image->move(public_path('product/'), $imageName);
        }
    
        $product                            = new Product();
        $product->category_id               = $request->category_id;
        $product->brand_id                  = $request->brand_id;
        $product->type_id                   = $request->type_id;
        $product->name                      = $request->name;
        $product->price                     = $request->price;
        $product->discount_percentage       = $request->discount_percentage;
        $product->slug                      = str_replace(' ','-',strtolower($request->name));
        $product->qty                       = $request->qty;
        $product->short_description         = $request->short_description;
        $product->long_description          = $request->long_description;
        $product->color                     = $request->color;
        $product->size                      = $request->size;
        $product->status                    = $request->status;
        $product->tag                       = $request->tag;
        $product->image                     = $imageName;

        $product->save();
    
        if($product->save()){
            foreach($request->file('images') as $productImage){
                $imagesName = $productImage->getClientOriginalName();
                $Images = $productImage->move(public_path('public/images/'), $imagesName);
    
                $productImages = new ProductPhoto();
                $productImages->product_id = $product->id;
                $productImages->images = $imagesName;
                $productImages->save();


            }
        }
        

        return redirect()->back()->with(session()->flash('success','Product added succesfully'));
        


    }

    public function manageProduct()
    {
        $products = Product::with('category','type','brand')->orderBy('created_at','desc')->get();
        return view('backend.product.manage' , compact('products'));

    }

    public function editProduct($id)
    {
        $product = Product::with('productPhotos')->find($id);
        $categories = Category::get();
        $brands = Brand::get();
        $types = Type::get();
        return view('backend.product.edit',compact('product','categories','brands','types'));
    }


    public function updateProduct(Request $request, $id)
    {
        $this->validate($request,[

            'category_id'               =>'required|integer',
            'brand_id'                  =>'required',
            'name'                      =>'required|string',
            'price'                     =>'required',
            'qty'                       =>'required|integer',
            'short_description'         =>'required|string',
            'long_description'          =>'required|string',
            'color'                     =>'required',
            'size'                      =>'required',
            'status'                    =>'required|integer',
            'image'                     =>'sometimes|nullable',
            'images'                    =>'sometimes|nullable',

        ]);

        

        $product =Product::find($id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->type_id = $request->type_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_percentage = $request->discount_percentage;
        $product->slug = str_replace(' ','-',strtolower($request->name));
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->status = $request->status;
        $product->tag = $request->tag;
       

        if($request->file('image')){
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $image= $request->image->move(public_path('product/'),$imageName);
            $product->image = $imageName;
        }

        $product->save();


        if($product->save()){

            if($request->file('images')){

                foreach($request->file('images') as $productImage){
                    $imagesName = $productImage->getClientOriginalName();
                    $Images = $productImage->move(public_path('public/images/'), $imagesName);
        
                    $productImages = new ProductPhoto();
                    $productImages->product_id = $product->id;
                    $productImages->images = $imagesName;
                    $productImages->save();
    
    
                }

            }
            
        }
        

        return redirect('/product/manage')->with(session()->flash('success','Product updated succesfully'));




    }





}
