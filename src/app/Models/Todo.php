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
        'sequence',
        'scheduled_at',
        'expired_at',
        'created_by',
        'updated_by',
        'deleted_by'
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

    /**
     * Get creator.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * Get editor.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editor(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    /**
     * Get remover.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function remover(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
