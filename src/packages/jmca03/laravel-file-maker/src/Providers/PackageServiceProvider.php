<?php

namespace Jmca03\LaravelFileMaker\Providers;

use Illuminate\Support\ServiceProvider;
use Jmca03\LaravelFileMaker\Console\Commands\MakeEnum;
use Jmca03\LaravelFileMaker\Console\Commands\MakeTrait;
use Jmca03\LaravelFileMaker\Console\Commands\MakeHelper;
use Jmca03\LaravelFileMaker\Console\Commands\MakeService;
use Jmca03\LaravelFileMaker\Console\Commands\MakeAbstract;
use Jmca03\LaravelFileMaker\Console\Commands\MakeInterface;
use Jmca03\LaravelFileMaker\Console\Commands\MakeRepository;

/**
 * Package Service Provider
 * @extends \Illuminate\Support\ServiceProvider
 */
class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     * 
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeEnum::class,
                MakeTrait::class,
                MakeHelper::class,
                MakeService::class,
                MakeAbstract::class,
                MakeInterface::class,
                MakeRepository::class,
            ]);
        }
    }
}
