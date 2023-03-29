<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Endereco;
use App\Models\Bairro;

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

        // Recupera o endereço do usuário autenticado
        $endereco = Endereco::where('user_id', auth()->user()->id)->first();

        // Adiciona o valor do frete ao preço total
        if ($endereco) {
            $totalPrice += $endereco->frete;
        }
        

        // Carrega a view com os itens do carrinho e o endereço do usuário autenticado
        return view('dashboard', compact('cartItems', 'totalPrice', 'endereco'));
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
        $cart = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();

        if ($cart) {
            // Se o produto já existe no carrinho do usuário autenticado, atualiza a quantidade de itens
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            // Se o produto não existe no carrinho do usuário autenticado, cria um novo item
            $cart = $user->cart ?: new Cart(['user_id' => $user->id]);
            $cart->product_id = $productId;
            $cart->quantity = $quantity;
            $cart->price += $productPrice * $quantity;
            $cart->save();
        }

        // Redireciona o usuário para a página do carrinho
        return redirect()->route('home')->with('success', 'Itens adicionado ao carrinho com sucesso!');
    }


    public function delete()
    {
        // Recupera o usuário autenticado
        $user = auth()->user();

        // Recupera todos os itens do carrinho que pertencem ao usuário autenticado
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Percorre todos os itens do carrinho e os deleta
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }

        // Redireciona o usuário para a página do carrinho com uma mensagem de sucesso
        return redirect()->route('dashboard')->with('success', 'Todos os itens do carrinho foram deletados com sucesso!');
    }

    public function deleteOne($id)
    {
        // Encontra o item do carrinho a ser excluído pelo ID
        $cartItem = Cart::findOrFail($id);

        // Verifica se o usuário logado tem permissão para excluir o item do carrinho
        if (auth()->id() !== $cartItem->user_id) {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para excluir este item do carrinho!');
        }

        // Deleta o item do carrinho
        $cartItem->delete();

        // Redireciona o usuário para a página do carrinho com uma mensagem de sucesso
        return redirect()->route('dashboard')->with('success', 'Item do carrinho excluído com sucesso!');
    }
}
