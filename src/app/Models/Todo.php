<?php

namespace App\Models;

use App\Traits\ModelScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory, SoftDeletes;
    use ModelScopeTrait;

    /** 
     * @var array <string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'scheduled_at',
        'expired_at'
    ];

    /**
     * Get user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
