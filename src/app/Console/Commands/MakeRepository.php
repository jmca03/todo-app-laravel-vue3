<?php

namespace Jmca03\LaravelFileMaker\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Create Repository Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeRepository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Make Repository Class";

    /**
     * Get Stub
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/repository.stub';
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Repositories';
    }
}
