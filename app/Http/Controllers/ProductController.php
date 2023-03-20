<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cartItems = Cart::all();
        $cartCount = 0;
        foreach ($cartItems as $item) {
            $cartCount += $item->quantity;
        }

        return view('home', compact('products', 'cartCount'));
    }
}
