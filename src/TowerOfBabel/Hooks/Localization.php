<?php


namespace TowerOfBabel\Hooks;

use TowerOfBabel\Plugin;

class Localization extends Hook {

    function get_type(): string {
        return "action";
    }

    public function get_hook(): string {
        return 'plugins_loaded';
    }

    public function callback(): void {
        load_plugin_textdomain(
            Plugin::NAME,
            false,
            dirname(plugin_basename(__FILE__), 2).'/languages/'
        );
    }
}