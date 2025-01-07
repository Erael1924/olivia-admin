<?php

namespace App\Providers;

use App\Interfaces\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Interfaces\PermissionRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Interfaces\SettingRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $repositories = [
        BaseRepositoryInterface::class => BaseRepository::class,
        PermissionRepositoryInterface::class => PermissionRepository::class,
        SettingRepositoryInterface::class => SettingRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
