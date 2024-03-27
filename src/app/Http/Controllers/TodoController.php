<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    /**
     * Constructor
     * 
     * @param TodoService $service
     */
    public function __construct(protected TodoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->service->index($request);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\TodoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TodoRequest $request): JsonResponse
    {
        return $this->service->store($request->toArray());
    }

    /**
     * Display the specified resource.
     * 
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string|int $id): JsonResponse
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\TodoRequest $request
     * @param string|int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TodoRequest $request, string|int $id)
    {
        return $this->service->update($id, $request->toArray());
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string|int $id): JsonResponse
    {
        return $this->service->destroy($id);
    }
}
