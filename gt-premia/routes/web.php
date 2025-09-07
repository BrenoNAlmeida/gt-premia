<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\TransacaoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(['role:rh|admin'])->group(function () { 

        //feedback
        Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
        Route::get('/feedback/{feedback}', [FeedbackController::class, 'show'])->name('feedback.show');
        Route::get('/feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
        Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
        Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');


        //  premio
        Route::post('/premio/store', [PremioController::class, 'store'])->name('premio.store');
        Route::get('/premio/create', [PremioController::class, 'create'])->name('premio.create');
        Route::put('/premio/{premio}', [PremioController::class, 'update'])->name('premio.update');
        Route::get('/premio/{premio}/edit', [PremioController::class, 'edit'])->name('premio.edit');
        Route::delete('/premio/{premio}', [PremioController::class, 'destroy'])->name('premio.destroy');
        

        //  usuarios
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::post('/usuarios/store', [UserController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
        Route::get('/usuarios/{user}', [UserController::class, 'show'])->name('usuarios.show');
        Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
        Route::put('/usuarios/{user}/resetar_senha', [UserController::class, 'resetar_senha'])->name('usuarios.resetar_senha');
        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    
        //  transacao
        Route::get('/transacao/create', [TransacaoController::class, 'create'])->name('transacao.create');
        Route::post('/transacao', [TransacaoController::class, 'store'])->name('transacao.store');
        Route::get('/transacao/{transacao}', [TransacaoController::class, 'show'])->name('transacao.show');
        Route::get('/transacao/{transacao}/edit', [TransacaoController::class, 'edit'])->name('transacao.edit');
        Route::put('/transacao/{transacao}', [TransacaoController::class, 'update'])->name('transacao.update');
        Route::delete('/transacao/{transacao}', [TransacaoController::class, 'destroy'])->name('transacao.destroy');
        Route::post('/transacao/{transacao}/aprovar', [TransacaoController::class, 'aprovar'])->name('transacao.aprovar');
        Route::post('/transacao/{transacao}/reprovar', [TransacaoController::class, 'reprovar'])->name('transacao.reprovar');
        
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/premio', [PremioController::class, 'index'])->name('premio.index');
    Route::get('/premio/{premio}', [PremioController::class, 'show'])->name('premio.show');
    Route::post('premio/{premio}/solicitar_retirada', [PremioController::class, 'solicitar_retirada'])->name('premio.solicitar_retirada');

    Route::get('/transacao', [TransacaoController::class, 'index'])->name('transacao.index');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');

    


});

require __DIR__ . '/auth.php';
