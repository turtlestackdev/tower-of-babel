<?php


namespace TowerOfBabel\Hooks;

use TowerOfBabel\Templates\Template;

class SettingsMenu extends Hook {
    function get_type(): HookType {
        return HookType::Action;
    }

    public function get_hook(): string {
        return 'admin_menu';
    }

    public function callback(): void {
        add_plugins_page(
            'Tower of Babel Settings',
            'Tower of Babel',
            'manage_options',
            'tower-of-babel-settings',
            [$this, 'html']
        );
    }

    public function html(): void {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        Template::load('settings');
    }
}