<?php


namespace TowerOfBabel\Hooks;


use InvalidArgumentException;
use TowerOfBabel\Plugin;
use TowerOfBabel\Utilities\Log;

abstract class Enqueue extends Hook {
    protected string $_id;
    protected HookArea $area;

    public function __construct(HookArea $area) {
        switch ($area) {
        case HookArea::Public:
            $this->_id = 'wp_enqueue_scripts';
            break;

        case HookArea::Admin:
            $this->_id = 'admin_enqueue_scripts';
            break;
        }

        $this->area = $area;
    }

    function get_type(): HookType {
        return HookType::Action;
    }

    public function get_id(): string {
        return $this->_id;
    }

    protected function callback(): void {
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