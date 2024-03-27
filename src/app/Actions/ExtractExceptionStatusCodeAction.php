<?php

namespace App\Actions;

use Exception;
use Throwable;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExtractExceptionStatusCodeAction
{
    use AsAction;

    /**
     * Handler
     * 
     * @param Exception|Throwable $e
     * @return int
     */
    public function handle(Exception|Throwable $e): int
    {
        if ($e instanceof ModelNotFoundException) {
            return 404;
        }

        if ($e instanceof HttpException) {
            return $e->getStatusCode();
        }

        return 500;
    }
}
