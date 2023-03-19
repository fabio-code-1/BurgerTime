<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

    public function dashboard()
    {
        // Recupera todos os itens do carrinho
        $cartItems = Cart::with('product')->get();

        // Filtra os itens que pertencem ao usuário autenticado
        $cartItems = $cartItems->filter(function ($item) {
            return $item->user_id == auth()->id();
        });

        // Calcula o valor total do carrinho
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        // Carrega a view com os itens do carrinho do usuário autenticado
        return view('dashboard', compact('cartItems', 'totalPrice'));
    }


    public function store(Request $request)
    {
        // Recupera o usuário autenticado
        $user = auth()->user();

        // Verifica se o usuário está autenticado
        if (!$user) {
            return redirect()->route('login');
        }

        // Recupera o id do produto a ser adicionado ao carrinho
        $productId = $request->input('product_id');

        // Verifica se o id do produto foi passado pelo formulário
        if (!$productId) {
            return back()->with('error', 'O id do produto não foi informado.');
        }

        // Recupera a quantidade a ser adicionada ao carrinho
        $quantity = $request->input('quantity', 1); // valor padrão é 1

        // Recupera o preço do produto
        $productPrice = Product::findOrFail($productId)->price;

        // Verifica se o produto já existe no carrinho
        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();

        if ($cartItem) {
            // Se o produto já existe no carrinho do usuário autenticado, atualiza a quantidade de itens
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Se o produto não existe no carrinho do usuário autenticado, cria um novo item
            $cart = $user->cart ?: new Cart(['user_id' => $user->id]);
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $productPrice
            ]);
        }

        // Redireciona o usuário para a página do carrinho
        return redirect()->route('dashboard');
    }
}
