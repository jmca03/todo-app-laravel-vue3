<?php

namespace App\Enums;

enum TodoLogCategoryEnum: string
{

    case CREATE = 'CREATE';
    case UPDATE = 'UPDATE';
    case DELETE = 'DELETE';

    /**
     * Use case instead of backed enum value.
     * 
     * @param string $value
     * @return string|int
     */
    public static function tryFromCase(string $value): string|int
    {
        return constant('self::' . $value);
    }
}
