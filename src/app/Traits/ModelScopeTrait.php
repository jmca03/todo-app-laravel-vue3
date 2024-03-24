<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ModelScopeTrait
{
    /**
     * Get row number
     * 
     * @param Builder $builder
     * @param ?string  $column
     */
    public function scopeRowNumber(
        Builder $builder,
        ?string $column = null
    ): void {
        /** @var string */
        $partitionedBy = $column ?: 'id';

        $builder->selectRaw(
            "ROW_NUMBER() OVER(PARTITION BY {$partitionedBy}"
        );
    }
}
