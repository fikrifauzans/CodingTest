<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MenuDetails extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table =  'menu_details';



    protected $fillable = [
        'parent_id', 'master_menu_id', 'menu_id'
    ];

    protected $hidden = [];

    public $searchable = [
        'name', 'master_menu_id', 'menu_id'
    ];


    public function Menu()
    {
        return $this->belongsTo(Menus::class, 'menu_id', 'id');
    }


    public function MasterMenu()
    {
        return $this->belongsTo(MasterMenus::class, 'master_menu_id', 'id');
    }

    public function Childs()
    {
        return $this->hasMany(Self::class, 'parent_id', 'id')->orderBy('sort', "ASC")->with('Menu');
    }
}
