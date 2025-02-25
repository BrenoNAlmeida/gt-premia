<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carteira extends Model
{
    /** @use HasFactory<\Database\Factories\CarteiraFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'saldo',
        'saldo_retido',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
