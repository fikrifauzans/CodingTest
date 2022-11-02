<?php

namespace App\Repositories\V1\Eloquent;

use App\Repositories\V1\Contracts\EloquentBaseRepository;
use App\Models\Model;
use App\Service\System\SystemInfo;
use App\Service\System\SystemQuery;

class BaseRepository implements EloquentBaseRepository
{
    use SystemQuery, SystemInfo;

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get($rawRequest = [], array $relations = [])
    {
        try {
            if ($rawRequest) return $this->queryController($this->model, $rawRequest, $relations);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findId($id = 0,  $withTrash = false,  $relations = [])
    {
        try {
            // dd($id);
            if ($withTrash) return $this->model->with($relations)->withTrashed()->findOrFail($id);
            else return  $this->model->with($relations)->findOrFail($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateOrCreate($id,  $data)
    {
        try {
            if ($id !== null) $val = $this->findId($id)->fill($data);
            else $val = $this->model->fill($data);
            $val->save();
            return $val;
        } catch (\Exception $e) {
            throw $e;
        }
        // return $val
    }

    public function destroy($id = 0, bool $permanent = false)
    {

        $data =  $this->findId($id, $permanent);
        try {
            if ($permanent) return $data->forceDelete();
            else return $data->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function restore(int $id = 0)
    {

        $data = $this->findId($id, true);
        try {
            return $data->restore();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
