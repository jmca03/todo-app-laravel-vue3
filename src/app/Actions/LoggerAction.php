<?php

namespace App\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class LoggerAction
{
    use AsAction;

    /**
     * Handler
     * 
     * @param ?string       $title
     * @param string|array  $message
     * @param string        $variant
     * @param array         $context
     * @return void
     */
    public function handle(
        ?string      $title = null,
        string|array $message = '',
        string       $variant = 'debug',
        array        $context = []
    ): void {

        $this->logger(message: $this->getSeparator(), variant: $variant);
        $this->logger(message: "| {$title}", variant: $variant);
        $this->logger(message: $this->getSeparator(), variant: $variant);
        $this->context($context);
        $this->logger(message: $this->message($message), variant: $variant, context: $context);
        $this->logger(message: $this->getSeparator(), variant: $variant);
    }

    /**
     * Logger
     * 
     * @param string $message
     * @param string $variant
     * @param array  $context
     * @return void
     */
    private function logger(string $message, string $variant = 'debug', array $context = []): void
    {
        match (Str::upper($variant)) {
            'INFO'      => Log::info($message, $context),
            'DEBUG'     => Log::debug($message, $context),
            'ERROR'     => Log::error($message, $context),
            'WARNING'   => Log::warning($message, $context),
            default     => Log::debug($message, $context)
        };
    }

    /**
     * Message
     * 
     * @return string
     */
    private function message(string|array $message = ''): string
    {
        return is_array($message) ? print_r($message, true) : "| {$message}";
    }

    /**
     * Add attribute to context
     * 
     * @param array $context
     * @return void
     */
    private function context(array &$context = []): void
    {
        if (!Arr::exists($context, 'timestamp')) {
            Arr::set($context, 'timestamp', now()->format('Y-m-d H:i:s'));
        }
    }

    /**
     * separator
     * 
     * @return string
     */
    private function getSeparator(): string
    {
        return '|------------------------------------------';
    }
}
