<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        // Busca as informações do carrinho do usuário logado
        $user_id = auth()->id();
        $cartItems = Cart::where('user_id', $user_id)->with('product')->get();
        $totalPrice = Cart::sum('price');

        // Cria a mensagem com as informações do carrinho
        $productsText = "Olá,\n\nGostaria de fazer este pedido:\n\n";
        $totalItems = 0;
        foreach ($cartItems as $item) {
            $totalItems += $item->quantity;
            $productsText .= "- " . $item->product->name . " (Preço: R$ " . number_format($item->product->price, 2, ',', '.') . ", Quantidade: " . $item->quantity . ", Total: R$ " . number_format($item->product->price * $item->quantity, 2, ',', '.') . ")\n";
        }
        $productsText .= "\n*Total da compra:* R$ " .
            number_format($totalPrice, 2, ',', '.') .
            "\n\n Nome: " .
            auth()->user()->name .
            "\n\nObrigado!";

        // Envia a mensagem para o WhatsApp
        $whatsappUrl = 'https://api.whatsapp.com/send?phone=5511986422678&text=' . urlencode($productsText);
        return redirect($whatsappUrl);
    }
}
