<?php


namespace TowerOfBabel\Hooks;


use InvalidArgumentException;
use TowerOfBabel\Plugin;
use TowerOfBabel\Utilities\Log;

abstract class Enqueue extends Hook {
    protected string $_hook;
    protected string $area;

    public function __construct(string $area) {
        switch (strtolower($area)) {
        case 'public':
            $this->area = 'public';
            $this->_hook = 'wp_enqueue_scripts';
            break;

        case 'admin':
            $this->area = 'admin';
            $this->_hook = 'admin_enqueue_scripts';
            break;

        default:
            Log::warning('invalid enqueue area: expected "public" or "admin"', ['area' => $area]);
            throw new InvalidArgumentException('invalid script area');
        }
    }

    function get_type(): string {
        return 'action';
    }

    public function get_hook(): string {
        return $this->_hook;
    }

    public function callback(): void {
        wp_enqueue_script(
            Plugin::NAME,
            $this->get_asset(),
            [],
            Plugin::VERSION,
            true
        );
    }

    abstract public function get_asset(): string;
}