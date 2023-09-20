<?php


namespace TowerOfBabel\Hooks;


use TowerOfBabel\Plugin;

class Style extends Enqueue {
    public function get_asset(): string {
        return Plugin::web_path("dist/tower-of-babel-{$this->area->value}.css");
    }

    protected function callback(): void {
        wp_enqueue_style(
            Plugin::NAME,
            $this->get_asset(),
            [],
            Plugin::VERSION,
        );
    }
}