<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\Users;
use App\Models\Roles;
use App\Models\MasterMenus;
use App\Models\Menus;
use App\Models\MenuDetails;
use App\Models\PermissionAccess;
use App\Models\Permissions;
use App\Repositories\V1\Interface\ISupersayanRepository;
use Illuminate\Support\Facades\Hash;


class SupersayanRepository extends BaseRepository implements ISupersayanRepository
{
    protected $users;

    public function __construct(
        Users $users,
        Roles $roles,
        MasterMenus $masterMenus,
    ) {
        $this->users = $users;
        $this->roles = $roles;
        $this->masterMenus = $masterMenus;
    }


    public function init()
    {
        Users::insert([
            // 'id' => 1,
            'name' => 'Supersayan',
            'email' => 'fikrifauzans.goku@gmail.com',
            'username' => 'supersayan',
            'npp' => 19982911,
            'password' => Hash::make('supersayan2118'),
            'supervisor_id' => null,
            'role_id' => 1
        ]);
        // Roles::insert(['id' => 1, 'name' => 'Master', 'master_menu_id' => 1]);
        // $menus = [
        //     ['name' => 'Dashboard',           'icon' => 'dashboard',       'path' => 'dashboard',        'link' => '/dashboard'],                   //1

        //     ['name' => 'Management Accounts', 'icon' => 'manage_accounts', 'path' => null,               'link' => null],                           //2
        //     ['name' => 'Users',               'icon' => 'person',          'path' => 'users',            'link' => '/management/users'],            //3
        //     ['name' => 'Roles',               'icon' => 'assignment_ind',  'path' => 'roles',            'link' => '/management/roles'],            //4
        //     ['name' => 'Menus',               'icon' => 'widgets',         'path' => 'menus',            'link' => '/management/menus'],            //5
        //     ['name' => 'Master Menus',        'icon' => 'menu_open',       'path' => 'master-menus',     'link' => '/management/master-menus'],     //6
        //     ['name' => 'Permissions',         'icon' => 'accessibility',   'path' => 'permissions',      'link' => '/management/permissions'],      //7
        //     ['name' => 'Files',               'icon' => 'source',          'path' => 'files',            'link' => '/management/files'],            //8
        // ];
        // Menus::insert($menus);
        // MasterMenus::insert([
        //     // 'id' => 1,
        //     'name' => 'Master',
        //     'status' => 1,
        // ]);
        // $masterMenus = [
        //     ['master_menu_id' => 1, 'parent_id' => null, 'menu_id' => 1, 'sort' => 1], //'id' => 1,
        //     ['master_menu_id' => 1, 'parent_id' => null, 'menu_id' => 2, 'sort' => 2], //'id' => 2,
        //     ['master_menu_id' => 1, 'parent_id' => 2,    'menu_id' => 3, 'sort' => 1], //'id' => 3,
        //     ['master_menu_id' => 1, 'parent_id' => 2,    'menu_id' => 4, 'sort' => 2], //'id' => 4,
        //     ['master_menu_id' => 1, 'parent_id' => 2,    'menu_id' => 5, 'sort' => 3], //'id' => 5,
        //     ['master_menu_id' => 1, 'parent_id' => 2,    'menu_id' => 6, 'sort' => 4], //'id' => 6,
        //     ['master_menu_id' => 1, 'parent_id' => 2,    'menu_id' => 7, 'sort' => 5], //'id' => 7,
        //     ['master_menu_id' => 1, 'parent_id' => 2,    'menu_id' => 8, 'sort' => 6], //'id' => 8,
        // ];
        // MenuDetails::insert($masterMenus);

        // //PERMISSIONS
        // $permissionsInit = [
        //     ['name' => 'Dashboard', 'slug' => 'dashboard'],
        //     ['name' => 'Users', 'slug' => 'users'],
        //     ['name' => 'Roles', 'slug' => 'roles'],
        //     ['name' => 'Menus', 'slug' => 'menus'],
        //     ['name' => 'Master Menus', 'slug' => 'master-menus'],
        //     ['name' => 'Permissions', 'slug' => 'permissions'],
        //     ['name' => 'Files', 'slug' => 'files'],
        // ];
        // $permissions = [];
        // foreach ($permissionsInit as $key => $permission) {

        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Index',    'slug' =>  $permission['slug'] . '-index']));
        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Show',     'slug' =>  $permission['slug'] . '-show']));
        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Update',   'slug' =>  $permission['slug'] . '-update']));
        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Store',    'slug' =>  $permission['slug'] . '-store']));
        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Restore',  'slug' =>  $permission['slug'] . '-restore']));
        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Delete',   'slug' =>  $permission['slug'] . '-delete']));
        //     array_push($permissions, Permissions::create(['name' => $permission['name'] . '/Force',    'slug' =>  $permission['slug'] . '-force']));
        // }

        // foreach ($permissions as $key => $access) {
        //     PermissionAccess::create(['permission_id' => $access['id'], 'role_id' => 1, 'status' => true]);
        // }
    }

    public function getMaster()
    {
        $user = Users::all();
        return $user;
    }
}
