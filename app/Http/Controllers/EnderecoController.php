<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\Bairro;

class EnderecoController extends Controller
{
    public function create()
    {
        $bairros = Bairro::all();
        return view('endereco.create', compact('bairros'));
    }

    public function store(Request $request)
    {
        $endereco = new Endereco();
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->complemento = $request->input('complemento');
        $endereco->cidade = $request->input('cidade');
        $endereco->estado = $request->input('estado');
        $endereco->bairro = $request->input('bairro');
        $endereco->frete = $request->input('valor_frete');
        $endereco->cep = $request->input('cep');
        $endereco->user_id = auth()->user()->id;
        $endereco->save();

        return redirect('dashboard')->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $address = Endereco::find($id);
        $bairros = Bairro::all();
        return view('endereco.edit', compact('address', 'bairros'));
    }


    public function update(Request $request, $id)
    {
        $endereco = Endereco::find($id);
        $endereco->cep = $request->input('cep');
        $endereco->rua = $request->input('rua');
        $endereco->numero = $request->input('numero');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');
        $endereco->cidade = $request->input('cidade');
        $endereco->estado = $request->input('estado');
        $endereco->frete = $request->input('valor_frete');
        $endereco->save();

        return redirect()->route('dashboard');
    }
}
