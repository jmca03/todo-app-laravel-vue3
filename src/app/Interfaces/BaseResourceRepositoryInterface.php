<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseResourceRepositoryInterface
{
    /**
     * Get all resources.
     * 
     * @param  Request $request
     * @return LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator;

    /**
     * Get specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function get(string|int $id): array;

    /**
     * Store new resource to storage.
     * 
     * @param  array $request
     * @return array
     */
    public function create(array $request): array;

    /**
     * Update the specified resource in the storage.
     * 
     * @param string|int $id
     * @param array $request
     * @return array
     */
    public function update(string|int $id, array $request): array;

    /**
     * Delete specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function delete(string|int $id): array;
}
