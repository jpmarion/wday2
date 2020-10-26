<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Autenticacion\User\Dominio\Interfaces\UserRepositorioItf;
use Src\Autenticacion\User\Infraestructura\AutenticacionCtrl;
use Src\Autenticacion\User\Infraestructura\Interfaces\AutenticacionItf;
use Src\Autenticacion\User\Infraestructura\Repositorios\EloquentUserRps;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AutenticacionItf::class,
            AutenticacionCtrl::class
        );

        $this->app->bind(
            UserRepositorioItf::class,
            EloquentUserRps::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
