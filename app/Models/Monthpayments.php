<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthpayments extends Model
{
    use HasFactory;

    public $table = 'monthpayments';

    protected $fillable = [
        'direccion_id', 'capture_month', 'capture_year', 'paid', 'description'
    ];

    public function direccion()
    {
        return $this->hasMany(Direcciones::class);
    }
}
