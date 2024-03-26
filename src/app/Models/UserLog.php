<?php

namespace App\Models;

use App\Traits\ModelScopeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLog extends Model
{
    use HasFactory, SoftDeletes;
    use ModelScopeTrait;

    /**
     * The attributes that should be cast.
     * 
     * @var array<object>
     */
    protected $casts = [
        'data' => 'array',
    ];

    /** 
     * @var array <string>
     */
    protected $fillable = [
        'user_id',
        'user_agent',
        'ip_address',
        'data',
        'category'
    ];

    /**
     * Get user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
