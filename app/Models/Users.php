<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'users';



    protected $fillable = [
        'name', 'email', 'username', 'address', 'password', 'role_id', 'npp', 'supervisor_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */


    protected $hidden = [
        'password',
    ];

    public $searchable = [
        'name', 'email', 'username', 'address', 'deleted_at'
    ];


    public function Role()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id')->with('MasterMenu');
    }
    public function Supervisor()
    {
        return $this->belongsTo(Self::class, 'supervisor_id', 'id');
    }
}
