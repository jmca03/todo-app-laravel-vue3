<?php

namespace App\Services;

use Throwable;
use Illuminate\Http\Request;
use App\Actions\LoggerAction;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Repositories\TodoRepository;
use App\Http\Resources\UserCollection;
use App\Actions\ExtractExceptionStatusCodeAction;

class TodoService
{

    use JsonResponseTrait;

    /**
     * Constructor
     * 
     * @param TodoRepository $repository
     * @return void
     */
    public function __construct(protected TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $resource = $this->repository->getAll($request);

            return $this->okResponse(
                UserCollection::collection($resource)
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('todo.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('todo.error_subtitle', [
                        'subtitle' => 'index method'
                    ])
                ]
            );

            return $this->jsonResponse(
                data: $request->toArray(),
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param array $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $request): JsonResponse
    {
        try {
            $resource = $this->repository->create($request);

            return $this->createdResponse(
                new UserResource($resource)
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('todo.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('todo.error_subtitle', [
                        'subtitle' => 'store method'
                    ])
                ]
            );

            return $this->jsonResponse(
                data: $request,
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string|int $id): JsonResponse
    {
        try {
            $resource = $this->repository->get($id);

            return $this->okResponse(
                new UserResource($resource)
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('todo.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('todo.error_subtitle', [
                        'subtitle' => 'show method'
                    ])
                ]
            );

            return $this->jsonResponse(
                data: [
                    'id' => $id
                ],
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param string|int $id
     * @param array $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string|int $id, array $request): JsonResponse
    {
        try {
            $resource = $this->repository->update($id, $request);

            return $this->okResponse(
                new UserResource($resource)
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('todo.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('todo.error_subtitle', [
                        'subtitle' => 'update method'
                    ])
                ]
            );

            return $this->jsonResponse(
                data: [
                    'id' => $id
                ],
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $resource = $this->repository->delete($id);

            return $this->okResponse(
                new UserResource($resource)
            );
        } catch (Throwable $th) {
            LoggerAction::run(
                title: __('todo.error_title'),
                message: $th->getMessage(),
                variant: 'error',
                context: [
                    'subtitle' => __('todo.error_subtitle', [
                        'subtitle' => 'destroy method'
                    ])
                ]
            );

            return $this->jsonResponse(
                data: [
                    'id' => $id
                ],
                statusCode: ExtractExceptionStatusCodeAction::run(e: $th),
                message: $th->getMessage()
            );
        }
    }
}
