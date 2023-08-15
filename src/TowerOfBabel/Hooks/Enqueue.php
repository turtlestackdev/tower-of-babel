<?php


namespace TowerOfBabel\Hooks;


use InvalidArgumentException;
use TowerOfBabel\Plugin;
use TowerOfBabel\Utilities\Log;

abstract class Enqueue extends Hook {
    protected string $_hook;
    protected HookArea $area;

    public function __construct(HookArea $area) {
        switch ($area) {
        case HookArea::Public:
            $this->_hook = 'wp_enqueue_scripts';
            break;

        case HookArea::Admin:
            $this->_hook = 'admin_enqueue_scripts';
            break;
        }

        $this->area = $area;
    }

    function get_type(): HookType {
        return HookType::Action;
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