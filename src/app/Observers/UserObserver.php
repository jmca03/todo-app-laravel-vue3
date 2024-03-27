<?php

namespace App\Observers;

use App\Enums\UserLogCategoryEnum;
use App\Models\User;
use App\Models\UserLog;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->logUser($user, UserLogCategoryEnum::CREATE->value);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->logUser($user, UserLogCategoryEnum::UPDATE->value);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->logUser($user, UserLogCategoryEnum::DELETE->value);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }

    /**
     * Log User
     * 
     * @param \App\Models\User $user
     * @return void
     */
    private function logUser(User $user, string $category): void
    {
        UserLog::factory()->create([
            'user_id' => $user->id,
            'user_agent' => request()->server('HTTP_USER_AGENT'),
            'ip_address' => request()->getClientIp(),
            'data' => $user->getOriginal(),
            'category' => $category
        ]);
    }
}
