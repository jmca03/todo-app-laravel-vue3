<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Actions\LoggerAction;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserRepository;
use App\Actions\ExtractExceptionStatusCodeAction;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AuthService
{

    use JsonResponseTrait;

    /**
     * Constructor
     * 
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(protected UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Login to app
     * 
     * @param  array $request
     * @return JsonResponse
     */
    public function login(array $request): JsonResponse
    {
        try {

            if (!Auth::attempt($this->credentials($request))) {
                // Log login attempt
                LoggerAction::run(
                    title: __('auth.error_subtitle'),
                    message: __('auth.failed'),
                    variant: 'error'
                );

                throw new UnprocessableEntityHttpException(__('auth.failed'));
            }

            return $this->okResponse(
                data: ['user' => Auth::user()->only(['id', 'username', 'email']), 'accessToken' => $this->generateToken()],
                message: __('auth.success')
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('auth.error_title'),
                message: $th->getMessage(),
                variant: 'error'
            );

            return $this->jsonResponse(
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }

    /**
     * Generate Token
     * 
     * @return string
     */
    private function generateToken(): string
    {
        /** @var User */
        $user = Auth::user();

        return $user->createToken(config('app.name'))->accessToken;
    }

    /**
     * Get Credentials
     * 
     * @param array $request
     * @return array
     */
    private function credentials(array $request): array
    {
        return Arr::only($request, ['username', 'password']);
    }
}
