<?php


namespace TowerOfBabel\Hooks;


use TowerOfBabel\Plugin;

class Script extends Enqueue {
    public function get_asset(): string {
        return Plugin::resource_path("js/tower-of-babel-$this->area.js");
    }
}