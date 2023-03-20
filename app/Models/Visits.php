<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visits extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'visits';

    protected $fillable = [
        'name',
        'plates',
        'visit_to',
        'registered_by',
    ];

    public function residence(){
        return $this->hasOne(Direcciones::class,'id','visit_to');
    }

    public function guardia(){
        return $this->hasOne(User::class,'id','registered_by');
    }

}