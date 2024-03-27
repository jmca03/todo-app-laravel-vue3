<?php

namespace App\Services;

use ErrorException;
use Throwable;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Actions\LoggerAction;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Actions\ExtractExceptionStatusCodeAction;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AuthService
{

    use JsonResponseTrait;

    /**
     * Constructor
     * 
     * @param \App\Repositories\UserRepository $userRepository
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
     * @return \Illuminate\Http\JsonResponse
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

            /** @var User */
            $user = Auth::user();

            return $this->okResponse(
                data: ['user' => $user->only(['id', 'username', 'email']), 'accessToken' => $this->generateToken()],
                message: __('auth.success')
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('auth.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('auth.error_subtitle', [
                        'subtitle' => 'login method'
                    ])
                ]
            );

            report($th);

            return $this->jsonResponse(
                data: Arr::only($request, 'username'),
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }

    /**
     * Logout
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            /** @var User */
            $user = Auth::user();

            $user->tokens->each(function ($token) {
                $token->delete();
            });

            return $this->okResponse(
                data: [],
                message: __('auth.logout.success')
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('auth.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('auth.error_subtitle', [
                        'subtitle' => 'logout method'
                    ])
                ]
            );

            report($th);


            return $this->jsonResponse(
                data: [],
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
