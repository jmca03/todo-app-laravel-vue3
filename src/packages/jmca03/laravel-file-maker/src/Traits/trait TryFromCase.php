<?php

namespace Jmca03\LaravelFileMaker\Traits;

trait TryFromCase
{
    /**
     * Try From Case
     * 
     * @param string $value
     * @return string|int
     */
    protected function tryFromCase(string $value): string|int
    {
        return constant('self::' . $value);
    }
}
