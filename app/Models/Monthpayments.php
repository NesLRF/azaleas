<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthpayments extends Model
{
    use HasFactory;

    public $table = 'monthpayments';

    protected $fillable = [
        'user_id', 'capture_month', 'capture_year', 'paid'
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
