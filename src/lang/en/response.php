<?php

/**
 * |--------------------------------------|
 * | Response
 * |--------------------------------------|
 */

return [
    'http' => [
        'ok' => [
            'code' => 200,
            'message' => 'Ok'
        ],
        'locked' => [
            'code' => 423,
            'message' => 'Locked'
        ],
        'created' => [
            'code' => 201,
            'message' => 'Created'
        ],
        'notFound' => [
            'code' => 494,
            'message' => 'Not Found'
        ],
        'forbidden' => [
            'code' => 403,
            'message' => 'Forbidden'
        ],
        'noContent' => [
            'code' => 204,
            'message' => 'No Content'
        ],
        'badRequest' => [
            'code' => 400,
            'message' => 'Bad Request'
        ],
        'unauthorized' => [
            'code' => 401,
            'message' => 'Unauthorized'
        ],
        'tooManyRequests' => [
            'code' => 429,
            'message' => 'Too Many Requests'
        ],
        'unprocessableEntity' => [
            'code' => 422,
            'message' => 'Unprocessable Entity'
        ],
        'internalServerError' => [
            'code' => 500,
            'message' => 'Internal Server Error'
        ]
    ]
];
