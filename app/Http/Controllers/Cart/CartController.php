<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function adToCart(Request $request)
    {

        $user_id = session()->get('userId');
        $ip_address = $request->ip();

        $existing = Cart::where('product_id', $request->product_id)
            ->where('user_id', $user_id)
            ->where('ip_address', $ip_address)
            ->first();
    
        if ($existing) {
            $existing->ip_address = $ip_address;
            $existing->user_id = $user_id;
            $existing->product_id = $request->product_id;
            $existing->price      = $request->product_price;
            $existing->qty = $existing->qty+1;
            $existing->total_price = $existing->qty*$request->product_price;
            $existing->save();
            return redirect()->back()->with(session()->flash('success', 'Product has been added to cart'));
        }else{
            $addToCart = new Cart();
            $addToCart->ip_address = $ip_address;
            $addToCart->user_id = $user_id;
            $addToCart->product_id = $request->product_id;
            $addToCart->price      = $request->product_price;
            $addToCart->qty = 1;
            $addToCart->total_price = 1*$request->product_price;
            $addToCart->save();
            return redirect()->back()->with(session()->flash('success', 'Product has been added to cart'));
        }

        

    }
}
