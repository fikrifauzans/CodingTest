<?php

namespace App\Repositories\V1\Eloquent;

use App\Models\Espresences;
use App\Repositories\V1\Interface\IEspresencesRepository;

class EspresencesRepository extends BaseRepository implements IEspresencesRepository
{
    protected $model;

    public function __construct(Espresences $model)
    {
        $this->model = $model;
    }
}
