<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\Permissions;
use App\Repositories\V1\Interface\IPermissionsRepository;

class PermissionsRepository extends BaseRepository implements IPermissionsRepository
{
    protected $model;

    public function __construct(Permissions $model)
    {
        $this->model = $model;
    }
}
