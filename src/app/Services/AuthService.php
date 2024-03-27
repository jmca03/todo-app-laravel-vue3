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
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AuthService
{

    use JsonResponseTrait;

    /** @var string */
    protected string $lang = 'auth';

    /**
     * Constructor
     * 
     * @param \App\Repositories\UserRepository $repository
     * @return void
     */
    public function __construct(protected UserRepository $repository)
    {
        $this->repository = $repository;
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
                    title: Lang::get($this->lang . '.error_title'),
                    message: Lang::get($this->lang . '.failed'),
                    variant: 'error'
                );

                throw new UnprocessableEntityHttpException(Lang::get($this->lang . '.failed'));
            }

            /** @var User */
            $user = Auth::user();

            return $this->okResponse(
                data: ['user' => $user->only(['id', 'username', 'email']), 'accessToken' => $this->generateToken()],
                message: Lang::get($this->lang . '.success')
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: Lang::get($this->lang . '.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => Lang::get($this->lang . '.error_subtitle', [
                        'subtitle' => 'LOGIN method'
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
                message: Lang::get($this->lang . '.logout.success')
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: Lang::get($this->lang . '.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => Lang::get($this->lang . '.error_subtitle', [
                        'subtitle' => 'LOGOUT method'
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
     * Register new account
     * 
     * @param array $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(array $request): JsonResponse
    {
        try {

            $resource = $this->repository->create($request);

            // send an verification email here

            return $this->createdResponse(
                data: $resource,
                message: Lang::get($this->lang . 'register.success')
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: Lang::get($this->lang . '.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => Lang::get($this->lang . '.error_subtitle', [
                        'subtitle' => 'REGISTER method'
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
