<?php


namespace TowerOfBabel\Hooks;


use TowerOfBabel\Plugin;

class Style extends Enqueue {
    public function get_asset(): string {
        return Plugin::resource_path("css/tower-of-babel-$this->area.css");
    }
}