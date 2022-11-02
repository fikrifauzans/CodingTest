<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\MasterMenus;
use App\Repositories\V1\Interface\IMasterMenusRepository;

class MasterMenusRepository extends BaseRepository implements IMasterMenusRepository
{
    protected $model;

    public function __construct(MasterMenus $model)
    {
        $this->model = $model;
    }
}
