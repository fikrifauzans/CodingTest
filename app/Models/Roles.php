<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Roles extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'roles';



    protected $fillable = [
        'name', 'status', 'master_menu_id'
    ];


    protected $hidden = [];

    public $searchable = [
        'name', 'status',
    ];


    public function MasterMenu()
    {
        return $this->belongsTo(MasterMenus::class, 'master_menu_id', 'id')->with('MenuDetails');
    }

    public function PermissionAccess()
    {
        return $this->hasMany(PermissionAccess::class, 'role_id');
    }
}
