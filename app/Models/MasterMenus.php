<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MasterMenus extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'master_menus';



    protected $fillable = [
        'name', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [];

    public $searchable = [
        'name', 'status',
    ];


    public function MenuDetails()
    {
        return $this->hasMany(MenuDetails::class, 'master_menu_id', 'id')
            ->where('parent_id', null)
            ->orderBy('sort', "ASC")
            ->with(['Menu', 'Childs']);
    }
}
