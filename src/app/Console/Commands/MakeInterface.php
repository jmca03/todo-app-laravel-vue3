<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;


/**
 * Create Interface Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Make Interface";

    /**
     * Get Stub
     * @return string
     */
    protected function getStub(): string
    {
        return base_path(path: 'stubs/interface.stub');
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Interfaces';
    }
}
