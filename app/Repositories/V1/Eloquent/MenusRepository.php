<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\Menus;
use App\Repositories\V1\Interface\IMenusRepository;

class MenusRepository extends BaseRepository implements IMenusRepository
{
    protected $model;

    public function __construct(Menus $model)
    {
        $this->model = $model;
    }
}
