<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;


/**
 * Create Enum Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeEnum extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:enum {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Enum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Make Enum";

    /**
     * Get Stub
     * @return string
     */
    protected function getStub(): string
    {
        return base_path(path: 'stubs/enum.stub');
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Enums';
    }
}
