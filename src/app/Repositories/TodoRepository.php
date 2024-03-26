<?php

namespace App\Repositories;

use App\Models\Todo;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\BaseResourceRepositoryInterface;

class TodoRepository implements BaseResourceRepositoryInterface
{
    /**
     * Constructor
     * 
     * @param Todo $todo
     * @return void
     */
    public function __construct(protected Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Get all resources.
     * 
     * @param  Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $todo = $this->todo->with([]);

        return $todo->paginate(
            Arr::get($request, 'page', config('paginate.default_pagination'))
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
        $todo = $this->todo->findOrFail($id);

        return $todo->toArray();
    }

    /**
     * Store new resource to storage.
     * 
     * @param  array $request
     * @return array
     */
    public function create(array $request): array
    {
        $todo = $this->todo->create($request);

        return $todo->toArray();
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
        $todo = $this->todo->findOrFail($id);

        $todo->update($request);

        return $todo->toArray();
    }

    /**
     * Delete specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function delete(string|int $id): array
    {
        $todo = $this->todo->findOrFail($id);

        $todo = $todo->deleteOrFail();

        return [];
    }
}
