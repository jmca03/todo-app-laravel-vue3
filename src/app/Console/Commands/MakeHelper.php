<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;


/**
 * Create Helper Class Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeHelper extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Make Helper Class";

    /**
     * Get Stub
     * @return string
     */
    protected function getStub(): string
    {
        return base_path(path: 'stubs/helper.stub');
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Helpers';
    }
}
