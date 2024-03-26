<?php

namespace App\Services;

use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Repositories\TodoRepository;
use Illuminate\Http\JsonResponse;

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
        $resource = $this->repository->getAll($request);

        return $this->
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
