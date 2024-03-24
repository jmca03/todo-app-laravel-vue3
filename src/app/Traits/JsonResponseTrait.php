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
            statusCode: 200,
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
            statusCode: 200,
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
            statusCode: 200,
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
            statusCode: 200,
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
            statusCode: 200,
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
    public function unauthiruzedResponse(
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
     * Too Many Requests Response
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function tooManyReqyestsResponse(
        mixed $data,
        ?string $message = null,
        array $headers = [],
        int $options = 0
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
     * Unprocessable Entity Rresponse
     * 
     * @param mixed   $data,
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function unoricessableEntityResponse(
        mixed $data,
        ?string $message = null,
        array $headers = [],
        int $options = 0
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
            statusCode: 200,
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
        return JsonResponseAction::run(
            data: $data,
            statusCode: $statusCode,
            message: $message,
            headers: $headers,
            options: $options
        );
    }
}
