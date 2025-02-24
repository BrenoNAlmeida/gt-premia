<?php

namespace App\Http\Controllers;

use App\Models\premio;
use App\Http\Requests\StorepremioRequest;
use App\Http\Requests\UpdatepremioRequest;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $premios = premio::all();

        //redireciona para a view index.blade.php
        return view('premio.index' , ['premios' => $premios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepremioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(premio $premio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(premio $premio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepremioRequest $request, premio $premio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(premio $premio)
    {
        //
    }

    public function solicitar_retirada(premio $premio)
    {
        $carteira = auth()->user()->carteira;   

        //verificar se o prêmio já foi solicitado
        if($premio->status == 'solicitado'){
            return redirect()->route('premio.index')->with('error', 'Prêmio já solicitado!');
        }
        //verificar se o usuário tem saldo suficiente para solicitar a retirada
        if($carteira->saldo < $premio->preco){
            return redirect()->route('premio.index')->with('error', 'Saldo insuficiente para solicitar a retirada!');
        }

        //usar o método update para atualizar o status do prêmio para "solicitado"
        $premio->update([
            'status' => 'solicitado',
            'retirado_por' => auth()->user()->id
        ]);

        //redirecionar para a rota premio.index com uma mensagem de sucesso
        return redirect()->route('premio.index')->with('success', 'Solicitação de retirada realizada com sucesso!');
    }

    public function aprovar_retidada(premio $premio)
    {
        //verificar se o usuário autenticado é um administrador
        if(auth()->user()->tipo != 'rh'){
            return redirect()->route('premio.index')->with('error', 'Você não tem permissão para aprovar retiradas!');
        }

        //usar o método update para atualizar o status do prêmio para "aprovado"
        $premio->update([
            'status' => 'aprovado',
            'aprovado_por' => auth()->user()->id
        ]);

        //redirecionar para a rota premio.index com uma mensagem de sucesso
        return redirect()->route('premio.index')->with('success', 'Retirada aprovada com sucesso!');
    }
}
