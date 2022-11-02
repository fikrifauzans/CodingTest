<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\Roles;
use App\Repositories\V1\Interface\IRolesRepository;

class RolesRepository extends BaseRepository implements IRolesRepository
{
    protected $model;

    public function __construct(Roles $model)
    {
        $this->model = $model;
    }

    public function updateChild($id, $request)
    {
        $ids = array_column($request, 'id');

        $PermissionAccess = $this->model->findOrFail($id)->PermissionAccess;

        $PermissionAccess->whereNotIn('id', $ids)->each(function ($data) {

            return $data->forceDelete();
        });

        $diffId = array_diff($ids, $PermissionAccess->whereIn('id', $ids)->pluck('id')->toArray());


        for ($i = 0; $i < count($diffId); $i++) {

            $this->model->PermissionAccess()->insert(['role_id' => $id, 'permission_id' => $diffId[$i]]);
        }
    }
}
