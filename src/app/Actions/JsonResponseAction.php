<?php

namespace App\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JsonResponseAction
{
    use AsAction;

    /**
     * Handler
     * 
     * @param mixed   $data,
     * @param int     $statusCode
     * @param ?string $message
     * @param array   $headers
     * @param int     $options
     * @return JsonResponse
     */
    public function handle(
        mixed   $data,
        int     $statusCode,
        ?string $message,
        array   $headers,
        int     $options
    ): JsonResponse {

        if ($data instanceof Collection || $data instanceof ResourceCollection || $data instanceof AnonymousResourceCollection) {

            return $data->additional([
                'message' => $message ?: $this->defaultMessage($statusCode),
                'statusCode' => $statusCode
            ])->response();
        }

        return Response::json([
            'data' => $data,
            'statusCode' => $statusCode,
            'message' => $message ?: $this->defaultMessage($statusCode)
        ], $statusCode, $headers, $options);
    }

    /**
     * Get language response
     * 
     * @param  int $statusCode
     * @return string
     */
    private function defaultMessage(int $statusCode = 200): string
    {

        $lang = fn (string $slug) => __("response.http.{$slug}.message");

        return match ($statusCode) {
            200 => $lang('ok'),
            423 => $lang('locked'),
            201 => $lang('created'),
            404 => $lang('notFound'),
            403 => $lang('forbidden'),
            204 => $lang('noContent'),
            400 => $lang('badRequest'),
            401 => $lang('unauthorized'),
            429 => $lang('tooManyRequests'),
            422 => $lang('unprocessableEntity'),
            500 => $lang('internalServerError'),
        };
    }
}
