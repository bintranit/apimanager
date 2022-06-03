<?php

namespace App\Providers;

use App\Modules\Thanhvien\Repositories\ThanhvienRepository;
use App\Modules\Thanhvien\Repositories\Interfaces\ThanhvienRepositoryInterface;
use App\Modules\Thanhvien\Services\ThanhvienService;
use App\Modules\Thanhvien\Services\Interfaces\ThanhvienServiceInterface;
use Illuminate\Support\ServiceProvider;

class ThanhvienServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ThanhvienRepositoryInterface::class,
            ThanhvienRepository::class
        );

        $this->app->bind(
            ThanhvienServiceInterface::class,
            ThanhvienService::class
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
