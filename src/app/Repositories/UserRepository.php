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
     * @param User $user
     * @return void
     */
    public function __construct(protected User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all resources.
     * 
     * @param  Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $user = $this->user->with([]);

        return $user->paginate(
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
        $user = $this->user->findOrFail($id);

        return $user->toArray();
    }

    /**
     * Store new resource to storage.
     * 
     * @param  array $request
     * @return array
     */
    public function create(array $request): array
    {
        $user = $this->user->create($request);

        return $user->toArray();
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
        $user = $this->user->findOrFail($id);

        $user->update($request);

        return $user->toArray();
    }

    /**
     * Delete specified resource.
     * 
     * @param  string|int $id
     * @return array
     */
    public function delete(string|int $id): array
    {
        $user = $this->user->findOrFail($id);

        $user = $user->deleteOrFail();

        return [];
    }
}
