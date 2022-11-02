<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PermissionAccess extends Model
{
    use SoftDeletes;

    /**`
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'permission_access';



    protected $fillable = [
        'permission_id', 'role_id', 'status'
    ];


    protected $hidden = [];

    public $searchable = [];
}
