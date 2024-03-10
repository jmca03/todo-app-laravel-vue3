<?php

namespace Jmca03\LaravelFileMaker\Console\Commands;

use Illuminate\Console\GeneratorCommand;


/**
 * Create Abstract Using Artisan Command
 * 
 * @extends GeneratorCommand
 */
class MakeAbstract extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:abstract {name}';

    /**
     * The type of class being generated.
     * 
     * @var string
     */
    protected $type = 'Abstract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Make Abstract Class";

    /**
     * Get Stub
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../stubs/abstract.stub';
    }

    /**
     * Get Default Namespace
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Abstracts';
    }
}
