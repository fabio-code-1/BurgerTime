<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $cartCount = 0;
        foreach ($cartItems as $item) {
            $cartCount += $item->quantity;
        }

        return view('home', compact('products', 'cartCount'));
    }
}
