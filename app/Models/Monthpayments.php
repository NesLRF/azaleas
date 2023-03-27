<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monthpayments extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'monthpayments';

    protected $fillable = [
        'direccion_id', 'capture_month', 'capture_year', 'paid', 'description'
    ];

    public function direccion()
    {
        return $this->hasMany(Direcciones::class,'id','direccion_id');
    }
}
