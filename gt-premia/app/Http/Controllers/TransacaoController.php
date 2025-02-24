<?php

namespace App\Http\Controllers;

use App\Models\transacao;
use App\Http\Requests\StoretransacaoRequest;
use App\Http\Requests\UpdatetransacaoRequest;
use App\Models\carteira;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(carteira $carteira)
    {
        
        return view('transacao.modal_adicionar_saldo', compact('carteira'));

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
    public function store(StoretransacaoRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(transacao $transacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transacao $transacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetransacaoRequest $request, transacao $transacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transacao $transacao)
    {
        //
    }

    public function adicionar_saldo(Request $request)
    {
        return view('transacao.adicionar_saldo');
    }
}
