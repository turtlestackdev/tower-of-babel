<?php


namespace TowerOfBabel\Templates;


use Symfony\Component\Filesystem\Path;

class Template {
    public static function load(string $template, mixed $data = []): void {
        $path = Path::join(plugin_dir_path(__FILE__), "$template.html.php");
        include $path;
    }
}