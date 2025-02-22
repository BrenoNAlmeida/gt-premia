<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transacao extends Model
{
    /** @use HasFactory<\Database\Factories\TransacaoFactory> */
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = [
        'tipo',
        'montante',
        'valor_recebido_id',
        'carteira_id',
        'premio_retirado_id',
    ];

    public function valor_recebido()
    {
        return $this->belongsTo(Valor::class);
    }

    public function carteira()
    {
        return $this->belongsTo(Carteira::class);
    }

    public function premio_retirado()
    {
        return $this->belongsTo(Valor::class);
    }


}
