<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condomino extends Model
{
    use HasFactory;

    protected $fillable = [
        'condomino', 'user_id', 'candados',
    ];

    protected $cast = [
        'data' => 'array',
    ];

    public function usuarios()
    {
        return $this->hasOne(User::class);
    }

    public function direccion()
    {
        return $this->hasOne(Direcciones::class);
    }
}
