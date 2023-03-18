<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direcciones extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'domicilio', 'condomino',
    ];

    public function owner()
    {
        return $this->belongsToMany(User::class, 'owner_condomino', 'direccion_id', 'user_id');
    }

    public function tenant()
    {
        return $this->belongsToMany(User::class, 'tenant_condomino', 'direccion_id', 'user_id');
    }

    public function monthpayments()
    {
        return $this->hasMany(monthpayments::class);
    }

}
