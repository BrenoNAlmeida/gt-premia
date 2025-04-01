<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\valor;
use App\Models\carteira;
use App\Models\premio;
use Illuminate\Database\Eloquent\SoftDeletes;


class transacao extends Model
{
    /** @use HasFactory<\Database\Factories\TransacaoFactory> */
    use HasFactory;    use SoftDeletes;


    protected $table = 'transacoes';

    protected $fillable = [
        'tipo',
        'montante',
        'status',
        'descricao',
        'valor_recebido_id',
        'carteira_id',
        'premio_retirado_id',
    ];

    public function valor_recebido()
    {
        return $this->belongsTo(valor::class);
    }

    public function carteira()
    {
        return $this->belongsTo(carteira::class);
    }

    public function premio_retirado()
    {
        return $this->belongsTo(premio::class, 'premio_retirado_id', 'id');
    }


}
