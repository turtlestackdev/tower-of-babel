<?php


namespace TowerOfBabel\Hooks;

use TowerOfBabel\Utilities\EntityLoader;

abstract class Hook extends EntityLoader {
    public function get_priority(): int { return 10; }

    public function get_accepted_args(): int { return 1; }

    abstract public function get_hook_name(): string;

    abstract function get_type(): HookType;
}