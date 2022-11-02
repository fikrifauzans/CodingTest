<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Espresences extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'espresences';



    protected $fillable = [
        'user_id', 'type', 'is_aprove', 'espresences', 'date',
    ];


    protected $hidden = [];

    public $searchable = [
        'type'
    ];


    public function User()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
