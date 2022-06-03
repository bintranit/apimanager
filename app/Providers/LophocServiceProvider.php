<?php

namespace App\Providers;

use App\Modules\Lophoc\Repositories\LophocRepository;
use App\Modules\Lophoc\Repositories\Interfaces\LophocRepositoryInterface;
use App\Modules\Lophoc\Services\LophocService;
use App\Modules\Lophoc\Services\Interfaces\LophocServiceInterface;
use Illuminate\Support\ServiceProvider;

class LophocServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            LophocRepositoryInterface::class,
            LophocRepository::class
        );

        $this->app->bind(
            LophocServiceInterface::class,
            LophocService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
