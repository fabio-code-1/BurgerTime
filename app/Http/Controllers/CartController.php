<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        return view('cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        // Recupera o id do produto a ser adicionado ao carrinho
        $productId = $request->input('product_id');

        // Verifica se o produto já existe no carrinho
        $cartItem = Cart::where('product_id', $productId)->first();

        if ($cartItem) {
            // Se o produto já existe no carrinho, atualiza a quantidade de itens
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Se o produto não existe no carrinho, cria um novo item
            Cart::create([
                'user_id' => 1,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        // Redireciona o usuário para a página do carrinho
        return redirect()->route('cart.index');
    }
}
