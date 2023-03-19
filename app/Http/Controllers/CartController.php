<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
 
    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('dashboard', compact('cartItems', 'totalPrice'));
    }



    public function store(Request $request)
    {
        // Recupera o id do produto a ser adicionado ao carrinho
        $productId = $request->input('product_id');

        // Verifica se o produto já existe no carrinho
        $cartItem = Cart::where('product_id', $productId)->first();

        // Recupera o id do usuário autenticado
        $userId = auth()->id();

        // Recupera a quantidade a ser adicionada ao carrinho
        $quantity = $request->input('quantity', 1); // valor padrão é 1

        if ($cartItem) {
            // Se o produto já existe no carrinho, atualiza a quantidade de itens
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Se o produto não existe no carrinho, cria um novo item
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        // Redireciona o usuário para a página do carrinho
        return redirect()->route('dashboard');
    }
}
