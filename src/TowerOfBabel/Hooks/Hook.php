<?php


namespace TowerOfBabel\Hooks;

use TowerOfBabel\Utilities\Log;

abstract class Hook {
    public function get_priority(): int { return 10; }

    public function get_accepted_args(): int { return 1; }

    abstract function get_type(): HookType;

    abstract public function get_hook(): string;

    abstract public function callback(): void;

    public function callback_wrapper() :void {
        try {
            $this->callback();
        } catch (\Exception $e) {
            Log::warning('hook callback failed', ['exception' => $e, 'hook' => self::class]);
        }
    }
}