<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
{
    parent::boot();

    $this->loadAppRoutes();
    //$this->loadModuleRoutes();
}

protected function loadAppRoutes(): void
{
    $this->routes(function () {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    });
}

///protected function loadModuleRoutes(): void
//{
   // foreach (glob(app_path('Modules/*/routes.php')) as $routeFile) {
       // Route::middleware('web')
      //      ->group($routeFile);
   // }
//}

}