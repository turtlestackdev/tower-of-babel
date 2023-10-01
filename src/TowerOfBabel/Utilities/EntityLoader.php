<?php


namespace TowerOfBabel\Utilities;

/**
 * This pattern is used throughout the codebase for passing callbacks into WordPress functions.
 */
abstract class EntityLoader {
    abstract protected function callback(): void;

    public function callback_wrapper(): void {
        try {
            $this->callback();
        } catch (\Exception $e) {
            Log::warning('wordpress callback failed', ['exception' => $e, 'hook' => self::class]);
        }
    }
}