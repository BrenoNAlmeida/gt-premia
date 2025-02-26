<?php

namespace App\Http\Controllers;

use App\Models\transacao;
use App\Http\Requests\StoretransacaoRequest;
use App\Http\Requests\UpdatetransacaoRequest;
use App\Models\carteira;
use App\Models\valor;
use Illuminate\Http\Request;

class TransacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('rg')){
            $transacoes = transacao::orderBy('status', 'desc')->get();
            return view('transacao.index', ['transacoes' => $transacoes]);
            
        }
        else{
            $transacoes = transacao::where('carteira_id', auth()->user()->carteira->id)
            ->orderBy('status', 'desc')->get();
            return view('transacao.index', ['transacoes' => $transacoes]);
        }

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
        $data = $request->all();
        $carteira = carteira::find($data['carteira_id']);
        $transacao = new transacao();
        if($data['tipo'] == 'entrada'){
            $valor_recebido = valor::find($data['valor']);
            $transacao->tipo = 'entrada';
            $transacao->descricao = 'Adição de saldo';
            $transacao->valor_recebido_id = $valor_recebido->id;
            $transacao->carteira_id = $carteira->id;
            $transacao->montante = $valor_recebido->cotacao;
            $transacao->save();

            $carteira->saldo += $valor_recebido->cotacao;
            $carteira->save();
        }
        //redireciona para a view a mesma view
        return redirect()->route('usuarios.index');
    }

    public function aprovar (transacao $transacao){
        $transacao->status = 'aprovado';
        $transacao->save();

        $carteira = carteira::find($transacao->carteira_id);
        $carteira->saldo_retido -= $transacao->montante;
        $carteira->save();


        return redirect()->route('transacao.index');
    }

    public function reprovar (transacao $transacao){
        $transacao->status = 'reprovado';
        $transacao->save();

        $carteira = carteira::find($transacao->carteira_id);
        $carteira->saldo += $transacao->montante;
        $carteira->saldo_retido -= $transacao->montante;
        $carteira->save();
        return redirect()->route('transacao.index');
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
