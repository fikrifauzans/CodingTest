<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\PermissionAccess;
use App\Repositories\V1\Interface\IPermissionAccessRepository;

class PermissionAccessRepository extends BaseRepository implements IPermissionAccessRepository
{
    protected $model;

    public function __construct(PermissionAccess $model)
    {
        $this->model = $model;
    }
}
