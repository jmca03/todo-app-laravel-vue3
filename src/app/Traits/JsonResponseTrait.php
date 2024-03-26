<?php

namespace App\Traits;

use App\Actions\JsonResponseAction;
use Illuminate\Http\JsonResponse;

trait JsonResponseTrait
{
    /**
     * Ok response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function okResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 200,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Created Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function createdResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 201,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Locked Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function lockedReponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 423,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Not Found Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function notFoundResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 404,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Forbidden Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function forbiddenResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 403,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * No Content Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function noContentResponse(
        mixed $data,
        ?string $message = null,
        array $headers = [],
        int $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 204,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Bad Request Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function badRequestResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 400,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Unauthorized Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function unauthorizedResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 401,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Too Many Requests Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function tooManyRequestsResponse(
        mixed $data,
        ?string $message = null,
        array $headers = [],
        int $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 429,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Unprocessable Entity Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function unprocessableEntityResponse(
        mixed $data,
        ?string $message = null,
        array $headers = [],
        int $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 422,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Internal Server Error Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function internalServerErrorResponse(
        mixed   $data,
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return JsonResponseAction::run(
            data: $data,
            statusCode: 500,
            message: $message,
            headers: $headers,
            options: $options
        );
    }

    /**
     * Json Response
     * 
     * @param mixed   $data,
     * @param int     $statusCode,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function jsonResponse(
        int     $statusCode,
        mixed   $data = [],
        ?string $message = null,
        array   $headers = [],
        int     $options = 0
    ): JsonResponse {
        return match ($statusCode) {
            200 => $this->okResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            423 => $this->lockedReponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            201 => $this->createdResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            404 => $this->notFoundResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            204 => $this->noContentResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            400 => $this->badRequestResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            401 => $this->unauthorizedResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            429 => $this->tooManyRequestsResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            500 => $this->internalServerErrorResponse(
                data: $data,
                message: $message,
                headers: $headers,
                options: $options
            ),
            default => JsonResponseAction::run(
                data: $data,
                statusCode: $statusCode,
                message: $message,
                headers: $headers,
                options: $options
            )
        };
    }
}
