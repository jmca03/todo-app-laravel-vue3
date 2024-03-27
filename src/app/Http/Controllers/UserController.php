<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Constructor
     * 
     * @param UserService $service
     */
    public function __construct(protected UserService $service)
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
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
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
     * @param \App\Http\Requests\UserRequest $request
     * @param string|int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, string|int $id)
    {
        return $this->service->update($id, $request->toArray());
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string|int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string|int $id)
    {
        return $this->service->destroy($id);
    }
}
