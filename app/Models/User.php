<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function month_payments()
    {
        return $this->hasMany(Monthpayments::class);
    }
    
    public function direccion()
    {
        return $this->hasOne(Direcciones::class);
    }

    public function properties()
    {
        return $this->belongsToMany(User::class, 'owner_condomino', 'user_id','direccion_id');
    }

    public function rents()
    {
        return $this->belongsToMany(User::class, 'tenant_condomino', 'user_id','direccion_id');
    }
}
