<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillsType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bills_types';

    protected $fillable = [
        'name',
    ];

}