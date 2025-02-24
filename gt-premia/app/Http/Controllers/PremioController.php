<?php

namespace App\Http\Controllers;

use App\Models\premio;
use App\Http\Requests\StorepremioRequest;
use App\Http\Requests\UpdatepremioRequest;
use App\Models\carteira;
use App\Models\transacao;

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
        auth()->user()->assignRole('rh');
        //auth()->user()->assignRole('admin');
        $carteira = carteira::where('user_id', auth()->user()->id)->first();  
        //verificar se o prêmio já foi solicitado
        if($premio->status == 'indisponivel'){
            return redirect()->route('premio.index')->with('error', 'Prêmio já solicitado!');
        }
        //verificar se o usuário tem saldo suficiente para solicitar a retirada
        if($carteira->saldo > $premio->preco){
            //atualiza carteira e deixa saldo como retido
            $carteira->saldo -= $premio->preco;
            $carteira->saldo_retido += $premio->preco;
            $carteira->save();
            //atualiza o status do prêmio para "solicitado"
            $transacao = new transacao();
            $transacao->tipo = 'saida';
            $transacao->descricao = 'Retirada de prêmio';
            $transacao->status = 'pendente';
            $transacao->montante = $premio->preco;
            $transacao->carteira_id = $carteira->id;
            $transacao->premio_retirado_id = $premio->id;
            $transacao->save();
            return redirect()->route('premio.index')->with('success', 'Solicitação de retirada realizada com sucesso!');
            
        }
        
        return redirect()->route('premio.index')->with('error', 'Saldo insuficiente para solicitar a retirada!');
        //redirecionar para a rota premio.index com uma mensagem de sucesso
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
