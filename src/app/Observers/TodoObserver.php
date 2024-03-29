<?php

namespace App\Observers;

use App\Enums\TodoLogCategoryEnum;
use App\Models\Todo;
use App\Models\TodoLog;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     * 
     * @param \App\Models\Todo $todo
     * @return void
     */
    public function created(Todo $todo): void
    {
        $this->logTodo($todo, TodoLogCategoryEnum::CREATE->value);
    }

    /**
     * Handle the Todo "updated" event.
     * 
     * @param \App\Models\Todo $todo
     * @return void
     */
    public function updated(Todo $todo): void
    {
        $this->logTodo($todo, TodoLogCategoryEnum::UPDATE->value);
    }

    /**
     * Handle the Todo "deleted" event.
     */
    public function deleted(Todo $todo): void
    {
        $this->logTodo($todo, TodoLogCategoryEnum::DELETE->value);
    }

    /**
     * Handle the Todo "restored" event.
     */
    public function restored(Todo $todo): void
    {
        //
    }

    /**
     * Handle the Todo "force deleted" event.
     */
    public function forceDeleted(Todo $todo): void
    {
        //
    }

    /**
     * Todo Log Factory
     * 
     * @param \App\Models\Todo $todo
     * @param string $category
     * @return void
     */
    private function logTodo(Todo $todo, string $category): void
    {
        TodoLog::factory()->create([
            'todo_id'       => data_get($todo, 'id'),
            'content'       => data_get($todo, 'content'),
            'scheduled_at'  => data_get($todo, 'scheduled_at'),
            'expired_at'    => data_get($todo, 'expired_at'),
            'data'          => $todo->getOriginal(),
            'category'      => $category
        ]);
    }
}
