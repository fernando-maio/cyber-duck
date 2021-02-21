<?php

namespace App\Providers;

use App\Contracts\Services\CompanyServiceInterface;
use App\Contracts\Services\EmployeeServiceInterface;
use App\Services\CompanyService;
use App\Services\EmployeeService;
use Illuminate\Support\ServiceProvider;

class ContractServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CompanyServiceInterface::class,
            CompanyService::class
        );

        $this->app->bind(
            EmployeeServiceInterface::class,
            EmployeeService::class
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
