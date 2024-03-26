<?php

namespace Jmca03\LaravelFileMaker\Console\Commands;

use Illuminate\Console\GeneratorCommand;


/**
 * Create Trait Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeTrait extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Trait';

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
        return __DIR__ . '/../../stubs/trait.stub';
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Traits';
    }
}
