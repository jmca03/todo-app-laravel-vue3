<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\BaseResourceRepositoryInterface;

class UserRepository implements BaseResourceRepositoryInterface
{
    /**
     * Constructor
     * 
     * @param User $resource
     * @return void
     */
    public function __construct(protected User $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Get all resources.
     * 
     * @param  Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $resource = $this->resource->with([]);

        return $resource->paginate(
            Arr::get($request, 'limit', config('paginate.limit'))
        );
    }

    /**
     * Get specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function get(string|int $id): array
    {
        $resource = $this->resource->findOrFail($id);

        return $resource->toArray();
    }

    /**
     * Store new resource to storage.
     * 
     * @param  array $request
     * @return array
     */
    public function create(array $request): array
    {
        $resource = $this->resource->create($request);

        return $resource->toArray();
    }

    /**
     * Update the specified resource in the storage.
     * 
     * @param string|int $id
     * @param array $request
     * @return array
     */
    public function update(string|int $id, array $request): array
    {
        $resource = $this->resource->findOrFail($id);

        $resource->update($request);

        return $resource->toArray();
    }

    /**
     * Delete specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function delete(string|int $id): array
    {
        $resource = $this->resource->findOrFail($id);

        $resource = $resource->deleteOrFail();

        return [];
    }
}
