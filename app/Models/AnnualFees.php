<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnualFees extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'annual_fees';

    protected $fillable = [
        'cuota',
        'year'
    ];

}
