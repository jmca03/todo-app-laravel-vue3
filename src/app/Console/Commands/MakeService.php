<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Actions\StringSplitAction;
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
     * 
     * @override
     * 
     * @param string $rootNamespace
     * @return string 
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }

    /**
     * Replace the class name for the given stub.
     * 
     * @override
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $newStub = Str::replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);

        $baseName = StringSplitAction::run($class);

        $baseName = Str::replace(['{{base}}', '{{ base }}'], head($baseName), $newStub);

        return Str::replace(['{{lowerBase}}', '{{ lowerBase }}'], Str::lower(head($baseName)), $newStub);
    }
}
