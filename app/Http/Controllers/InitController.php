<?php

namespace App\Http\Controllers;

use App\Repositories\V1\Interface\ISupersayanRepository;
use Illuminate\Support\Facades\Artisan;


class InitController extends Controller
{
    public  $repository;

    public function __construct(ISupersayanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function init()
    {
        // try {
        Artisan::call('migrate:fresh', [
            '--path' => 'database/migrations/auth',
            '--force'     => true,
            '--seed'      => true,

        ]);
        $this->repository->init();
        return  $this->repository->getMaster();
    }
}
