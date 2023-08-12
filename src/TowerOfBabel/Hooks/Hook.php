<?php


namespace TowerOfBabel\Hooks;

abstract class Hook {
    public function get_priority(): int { return 10; }

    public function get_accepted_args(): int { return 1; }

    abstract function get_type(): string;

    abstract public function get_hook(): string;

    abstract public function callback(): void;
}