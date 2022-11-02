<?php

namespace App\Repositories\V1\Contracts;


interface EloquentBaseRepository
{
    public function get(array $rawRequest = [], array $relations = []);

    public function findId(int $id = 0, array $relations = []);

    public function updateOrCreate($id,  $data);

    public function destroy(int $id = 0, bool $permanent = false);

    public function restore(int $id = 0);
}
