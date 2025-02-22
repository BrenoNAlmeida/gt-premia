<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class premio extends Model
{
    /** @use HasFactory<\Database\Factories\PremioFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'status',
        'imagem_path',
        'imagem_nome',
        'preco',
        'quantidade',
        'retirado_por',
        
    ];


    public function retirado_por()
    {
        return $this->belongsTo(User::class);
    }

}
