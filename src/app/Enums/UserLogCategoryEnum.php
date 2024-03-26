<?php

namespace App\Enums;

enum UserLogCategoryEnum: string
{
    case LOGIN = 'LOGIN';
    case LOGOUT = 'LOGOUT';
    case CREATE = 'CREATE';
    case UPDATE = 'UPDATE';
    case DELETE = 'DELETE';
    case DISABLE = 'DISABLE';

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
