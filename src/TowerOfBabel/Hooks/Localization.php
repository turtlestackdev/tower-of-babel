<?php


namespace TowerOfBabel\Hooks;

use TowerOfBabel\Plugin;

class Localization extends Hook {

    function get_type(): HookType {
        return HookType::Action;
    }

    public function get_id(): string {
        return 'plugins_loaded';
    }

    protected function callback(): void {
        load_plugin_textdomain(
            Plugin::NAME,
            false,
            dirname(plugin_basename(__FILE__), 2).'/languages/'
        );
    }
}