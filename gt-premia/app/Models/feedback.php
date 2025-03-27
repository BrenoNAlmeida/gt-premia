<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'valor_indicacao_id',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function valor_indicacao()
    {
        return $this->hasOne(Valor::class, 'id', 'valor_indicacao_id');
    }

}
