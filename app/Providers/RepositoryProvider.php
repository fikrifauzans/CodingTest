<?php

namespace App\Providers;

use App\Repositories\V1\Contracts\EloquentBaseRepository;
use App\Repositories\V1\Eloquent\BaseRepository;
use App\Repositories\V1\Eloquent\UsersRepository;
use App\Repositories\V1\Interface\IUsersRepository;
use App\Repositories\V1\Eloquent\SupersayanRepository;
use App\Repositories\V1\Interface\ISupersayanRepository;
use App\Repositories\V1\Eloquent\RolesRepository;
use App\Repositories\V1\Interface\IRolesRepository;
use App\Repositories\V1\Eloquent\MasterMenusRepository;
use App\Repositories\V1\Interface\IMasterMenusRepository;
use App\Repositories\V1\Eloquent\MenuDetailsRepository;
use App\Repositories\V1\Interface\IMenuDetailsRepository;
use App\Repositories\V1\Eloquent\MenusRepository;
use App\Repositories\V1\Interface\IMenusRepository;
use App\Repositories\V1\Eloquent\PermissionsRepository;
use App\Repositories\V1\Interface\IPermissionsRepository;
use App\Repositories\V1\Eloquent\PermissionAccessRepository;
use App\Repositories\V1\Interface\IPermissionAccessRepository;
use App\Repositories\V1\Eloquent\EspresencesRepository;
use App\Repositories\V1\Interface\IEspresencesRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryProvider extends ServiceProvider
{

    public function boot()
    {
        # code...
    }

    public function register()
    {
        $this->app->bind(EloquentBaseRepository::class,  BaseRepository::class);
        $this->app->bind(ISupersayanRepository::class,  SupersayanRepository::class);
        $this->app->bind(IUsersRepository::class,  UsersRepository::class);
        $this->app->bind(IUsersRepository::class,  UsersRepository::class);
        $this->app->bind(IRolesRepository::class,  RolesRepository::class);
        $this->app->bind(IMasterMenusRepository::class,  MasterMenusRepository::class);
        $this->app->bind(IMenuDetailsRepository::class,  MenuDetailsRepository::class);
        $this->app->bind(IMenusRepository::class,  MenusRepository::class);
        $this->app->bind(IPermissionsRepository::class,  PermissionsRepository::class);
        $this->app->bind(IPermissionAccessRepository::class,  PermissionAccessRepository::class);
        $this->app->bind(IEspresencesRepository::class,  EspresencesRepository::class);
    }
}
