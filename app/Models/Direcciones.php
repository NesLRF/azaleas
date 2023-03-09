<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'domicilio', 'condomino',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
