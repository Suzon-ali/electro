<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()

    {
        $user_id = session()->get('userId');
        $ip_address = request()->ip();
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->orWhere('ip_address', $ip_address)->get();

        $categories = Category::where('status','1')->get();
        $products = Product::where('status','1')->get();
        $newProducts = Product::with('favorite')->orderBy('created_at', 'desc')->where('status','1')->limit(10)->get();
        $typeProduct = Product::with('type','favorite')->where('status','1')->get();
        $favourite = Favorite::with('product')->where('ip_address', request()->ip())->get();
        $productIds = $favourite->pluck('product.id')->toArray();
        
        return view('frontend.home.index', compact('categories','products','typeProduct','newProducts','favourite','productIds','cartProducts'));
    }

    public function store($id, $slug)
    {
        $user_id = session()->get('userId');
        $ip_address = request()->ip();
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->orWhere('ip_address', $ip_address)->get();

        $categories = Category::where('status','1')->get();
        $category = Category::with('product')->find($id);
        $productCount = $category->product->count();
        $favourite = Favorite::with('product')->where('ip_address', request()->ip())->get();
        $productIds = $favourite->pluck('product.id')->toArray();
        return view('frontend.home.store', compact('categories','category','productCount','favourite','productIds','cartProducts'));
    }

    public function productDetails($id)
    {
        $user_id = session()->get('userId');
        $ip_address = request()->ip();
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->orWhere('ip_address', $ip_address)->get();

        $categories = Category::where('status','1')->get();
        $product = Product::with('productPhotos','category','brand')->where('status','1')->find($id);
        $products = Product::with('productPhotos','category','brand')->where('status','1')->get();
        $favourite = Favorite::with('product')->where('ip_address', request()->ip())->get();
        $productIds = $favourite->pluck('product.id')->toArray();
        return view('frontend.home.product', compact('product','categories','favourite','productIds','products','cartProducts'));

    }

    

    
}
