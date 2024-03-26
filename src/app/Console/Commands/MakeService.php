<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;


/**
 * Create Service Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Make Service Class";

    /**
     * Get Stub
     * @return string
     */
    protected function getStub(): string
    {
        return base_path(path: 'stubs/service.stub');
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }
}
