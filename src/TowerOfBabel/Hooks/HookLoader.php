<?php


namespace TowerOfBabel\Hooks;

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
            switch ($hook->get_type()) {
            case HookType::Action:
                add_action($hook->get_hook(), [$hook, 'callback_wrapper'], $hook->get_priority(), $hook->get_accepted_args());
                break;
            case HookType::Filter:
                add_filter($hook->get_hook(), [$hook, 'callback_wrapper'], $hook->get_priority(), $hook->get_accepted_args());
                break;
            }
        }
    }
}