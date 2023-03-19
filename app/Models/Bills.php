<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bills extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bills';

    protected $fillable = [
        'bills_type_id',
        'amount',
        'description'
    ];

    public function type(){
        return $this->hasOne(BillsType::class,'id','bills_type_id');
    }

}