<?php

/**
 * |--------------------------------------|
 * | Token Configuration
 * |--------------------------------------|
 */
return [
    'expires_in' => env('TOKEN_EXPIRES_IN', 15),
    'expires_in_unit' => env('TOKEN_EXPIRES_IN_UNIT', 'hours'),
    'refresh' => [
        'expires_in' => env('REFRESH_TOKEN_EXPIRES_IN', 15),
        'expires_in_unit' => env('REFRESH_TOKEN_EXPIRES_IN_UNIT', 'hours'),
    ],
    'personal' => [
        'expires_in' => env('PERSONAL_TOKEN_EXPIRES_IN', 15),
        'expires_in_unit' => env('PERSONAL_TOKEN_EXPIRES_IN_UNIT', 'hours'),
    ]
];
