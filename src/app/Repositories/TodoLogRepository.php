<?php

namespace App\Repositories;

use App\Models\TodoLog;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\BaseResourceRepositoryInterface;

class TodoLogRepository implements BaseResourceRepositoryInterface
{
    /**
     * Constructor
     * 
     * @param TodoLog $todoLog
     * @return void
     */
    public function __construct(protected TodoLog $todoLog)
    {
        $this->todoLog = $todoLog;
    }

    /**
     * Get all resources.
     * 
     * @param  Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $todoLog = $this->todoLog->with([]);

        return $todoLog->paginate(
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
        $todoLog = $this->todoLog->findOrFail($id);

        return $todoLog->toArray();
    }

    /**
     * Store new resource to storage.
     * 
     * @param  array $request
     * @return array
     */
    public function create(array $request): array
    {
        $todoLog = $this->todoLog->create($request);

        return $todoLog->toArray();
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
        $todoLog = $this->todoLog->findOrFail($id);

        $todoLog->update($request);

        return $todoLog->toArray();
    }

    /**
     * Delete specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function delete(string|int $id): array
    {
        $todoLog = $this->todoLog->findOrFail($id);

        $todoLog = $todoLog->deleteOrFail();

        return [];
    }
}
