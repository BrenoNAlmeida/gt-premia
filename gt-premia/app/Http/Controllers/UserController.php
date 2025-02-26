<?php

namespace App\Http\Controllers;

use App\Models\carteira;
use App\Models\transacao;
use App\Models\User;
use App\Models\valor;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'cpf' => ['required'],
        ]);

        //remove a mascara do cpf
        $request['cpf'] = preg_replace("/[^0-9]/", "", $request['cpf']);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->cpf),
            'cpf' => $request->cpf,
        ]);
        $user->assignRole($request['grupo']);

        $carteira = Carteira::create([
            'user_id' => $user->id,
        ]);
        $user->carteira_id = $carteira->id;
        $user->save();  

        event(new Registered($user));

        return redirect()->route('usuarios.index');

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
    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {
        //atualiza os dados
        $request['cpf'] = preg_replace("/[^0-9]/", "", $request['cpf']);
        $User->update($request->all());
        return redirect()->route('usuarios.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }

    public function resetar_senha(User $user)
    {
        $user->password = Hash::make($user->cpf);
        $user->save();
        return redirect()->route('usuarios.index');
    }
}
