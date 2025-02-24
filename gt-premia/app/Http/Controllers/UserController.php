<?php

namespace App\Http\Controllers;

use App\Models\carteira;
use App\Models\transacao;
use App\Models\User;
use App\Models\valor;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {   

        $usuario = $user;
        $transacoes = transacao::where('carteira_id', $usuario->carteira_id)->get();
        $carteira = carteira::where('user_id', $usuario->id)->first();
        $valores = valor::all();
        return view('usuarios.show', compact('usuario', 'transacoes', 'carteira', 'valores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }
}
