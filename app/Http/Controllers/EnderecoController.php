<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
class EnderecoController extends Controller
{
    public function create()
    {
        return view('endereco.create');
    }

    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->complemento = $request->input('complemento');
        $endereco->cidade = $request->input('cidade');
        $endereco->estado = $request->input('estado');
        $endereco->cep = $request->input('cep');
        $endereco->user_id = auth()->user()->id;
        $endereco->save();

        return redirect('/')->with('success', 'Endereço cadastrado com sucesso!');
    }
}
