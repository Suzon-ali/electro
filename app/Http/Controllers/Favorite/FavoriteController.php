<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addToFavorite(Request $request)
    {
        $user_id = session()->get('userId');
        $product_id = $request->product_id;
        $ip_address = $request->ip();
    
        // Check if the product already exists in the favorites table
        $existing = Favorite::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->where('ip_address', $ip_address)
            ->first();
    
        if ($existing) {
            return redirect()->back()->with(session()->flash('error', 'Product is already in your favorites'));
        }
    
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->product_id = $product_id;
        $favorite->qty = 1;
        $favorite->price = $request->price;
        $favorite->ip_address = $ip_address;
        $favorite->save();
    
        return redirect()->back()->with(session()->flash('success', 'Product has been added to favorites'));
    }
    

   public function userfavouriteList($id)
   {

        $user_id = session()->get('userId');
        $ip_address = request()->ip();
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->orWhere('ip_address', $ip_address)->get();

       $user_id = session()->get('userId'); 
       $categories = Category::where('status','1')->get();
       $favourites = Favorite::with('product')->where('user_id', $id )->orWhere('ip_address', request()->ip())->get();
       return view('frontend.home.favourite', compact('categories','favourites','cartProducts'));
   }

   public function favouriteList()
   {
        $user_id = session()->get('userId');
        $ip_address = request()->ip();
        $cartProducts = Cart::with('product')->where('user_id', $user_id)->orWhere('ip_address', $ip_address)->get();

       $categories = Category::where('status','1')->get();
       $favourites = Favorite::with('product')->where('ip_address', request()->ip())->get();
       return view('frontend.home.favourite', compact('categories','favourites','cartProducts'));
   }

   public function deleteFromFavorite($id)
   {
    try {
        $favourite = Favorite::where('product_id', $id)->where('ip_address', request()->ip())->firstOrFail();
        $favourite->delete();
        return redirect()->back()->with(session()->flash('success', 'Product has been removed from favorites'));
    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with(session()->flash('error', 'Favorite item not found'));
    }

   }

   
}
