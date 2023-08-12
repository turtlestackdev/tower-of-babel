<?php


namespace TowerOfBabel\Hooks;

use TowerOfBabel\Utilities\Log;

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 */
class HookLoader {
    protected array $hooks = [];

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     */
    public function add_hook(Hook $hook): void {
        $this->hooks[] = $hook;
    }

    /**
     * Register the filters and actions with WordPress.
     */
    public function run(): void {
        /** @var Hook $hook */
        foreach ($this->hooks as $hook) {
            switch (strtolower($hook->get_type())) {
            case 'action':
                add_action($hook->get_hook(), [$hook, 'callback'], $hook->get_priority(), $hook->get_accepted_args());
                break;
            case 'filter':
                add_filter($hook->get_hook(), [$hook, 'callback'], $hook->get_priority(), $hook->get_accepted_args());
                break;
            default:
                Log::error("skipping hook, invalid type", ['hook' => $hook]);
            }
        }
    }
}