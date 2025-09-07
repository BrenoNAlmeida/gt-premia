<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valor extends Model
{
    /** @use HasFactory<\Database\Factories\ValorFactory> */
    use HasFactory;

    protected $table = 'valores';

    protected $fillable = [
        'nome',
        'cotacao',
    ];
}
