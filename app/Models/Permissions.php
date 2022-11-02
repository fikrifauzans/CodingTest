<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Permissions extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'permissions';



    protected $fillable = [
        'name', 'slug'
    ];


    protected $hidden = [];

    public $searchable = [
        'name', 'slug'
    ];
}
