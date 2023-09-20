<?php


namespace TowerOfBabel\Hooks;


use TowerOfBabel\Plugin;

class Script extends Enqueue {
    public function get_asset(): string {
        return Plugin::web_path("js/tower-of-babel-{$this->area->value}.js");
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
}