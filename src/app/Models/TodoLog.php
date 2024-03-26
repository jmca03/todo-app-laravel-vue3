<?php

namespace App\Models;

use App\Traits\ModelScopeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoLog extends Model
{
    use HasFactory, SoftDeletes;
    use ModelScopeTrait;

    /** 
     * @var array<string>
     */
    protected $fillable = [
        'todo_id',
        'content',
        'scheduled_at',
        'expired_at'
    ];

    /**
     * Get Todo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class, 'todo_id', 'id');
    }
}
