<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\MenuDetails;
use App\Repositories\V1\Interface\IMenuDetailsRepository;

class MenuDetailsRepository extends BaseRepository implements IMenuDetailsRepository
{
    protected $model;

    public function __construct(MenuDetails $model)
    {
        $this->model = $model;
    }
}
