<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    // Recupera todos os produtos da base de dados
    $products = Product::all();
    
    // Retorna a view que será exibida na página inicial, passando os produtos como parâmetro
    return view('home', ['products' => $products]);
}

}
