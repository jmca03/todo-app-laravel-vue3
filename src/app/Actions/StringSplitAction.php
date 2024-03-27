<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

final class StringSplitAction
{
    use AsAction;

    /**
     * Handler
     * 
     * @param  string $value
     * @return array
     */
    public function handle(string $value): array
    {
        $newString = Str::headline($value);

        return Str::of($newString)->split('/\s+/')->toArray();
    }
}
