<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Endereco;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        // Busca as informações do carrinho do usuário logado
        $user_id = auth()->id();
        $cartItems = Cart::where('user_id', $user_id)->with('product')->get();
        $totalPrice = 0;
        $totalItems = 0;

        // Busca o endereço do usuário para obter a taxa de entrega e adicionar à mensagem
        $userAddress = Endereco::where('user_id', $user_id)->first();
        $tax = $userAddress ? $userAddress->frete : 0; // taxa de entrega
        $addressText = '';
        if ($userAddress) {
            $addressText = "\n\n*Endereço de entrega:*\n" .
                "Rua " . $userAddress->rua . ", " . $userAddress->numero . "\n" .
                "Bairro: " . $userAddress->bairro . "\n" .
                "Cidade: " . $userAddress->cidade . "\n" .
                "CEP: " . $userAddress->cep . "\n";
        }

        // Cria a mensagem com as informações do carrinho
        $productsText = "Olá,\n\nGostaria de fazer este pedido:\n\n";
        foreach ($cartItems as $item) {
            $totalItems += $item->quantity;
            $itemPrice = $item->product->price * $item->quantity;
            $productsText .= "Produto: " . $item->product->name . "\n" .
                "Preço: R$ " . number_format($item->product->price, 2, ',', '.') . "\n" .
                "Quantidade: " . $item->quantity . "\n" .
                "Total: R$ " . number_format($itemPrice, 2, ',', '.') . "\n\n";
            $totalPrice += $itemPrice;
        }
        $totalPrice += $tax; // adiciona a taxa ao total

        // Verifica se o usuário escolheu dinheiro como forma de pagamento
        $paymentMethod = request()->input('payment_method');
        $changeText = ''; // Variável para armazenar a mensagem de troco
        if ($paymentMethod === 'cash') {
            // Se a forma de pagamento for dinheiro, calcula o troco
            $received = request()->input('change_amount');
            $change = $received - $totalPrice;
            $changeText = "*Forma de pagamento:* Dinheiro\n" .
                "*Total da compra:* R$ " . number_format($totalPrice, 2, ',', '.') . "\n" .
                "*Dinheiro a ser recebido:* R$ " . number_format($received, 2, ',', '.') . "\n" .
                "*Troco:* R$ " . number_format($change, 2, ',', '.') . "\n";
        } else {
            // Se a forma de pagamento não for dinheiro, adiciona apenas o total da compra à mensagem
            $changeText = "*Forma de pagamento:* " . $paymentMethod . "\n" .
                "*Total da compra:* R$ " . number_format($totalPrice, 2, ',', '.') . "\n";
        }

        $productsText .= $changeText . "*Taxa de entrega:* R$ " . number_format($tax, 2, ',', '.') . $addressText .
            "\n\n*Receber a Entrega*: " . auth()->user()->name . "\n\nObrigado!";

        // Envia a mensagem para o WhatsApp
        $whatsappUrl = 'https://api.whatsapp.com/send?phone=5511986422678&text=' . urlencode($productsText);

        // Redireciona para a URL do WhatsApp
        return redirect()->away($whatsappUrl);
    }
}
