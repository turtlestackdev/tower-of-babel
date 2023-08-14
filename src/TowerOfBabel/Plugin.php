<?php


namespace TowerOfBabel;


use TowerOfBabel\Hooks\HookLoader;
use TowerOfBabel\Hooks\Localization;
use TowerOfBabel\Hooks\Script;
use TowerOfBabel\Hooks\Style;
use TowerOfBabel\Utilities\Log;
use TowerOfBabel\Utilities\Path;

class Plugin {
    const NAME = 'tower-of-babel';
    const VERSION = '0.1.0';
    protected HookLoader $loader;

    public function __construct() {
        try {
            $this->loader = new HookLoader();
            $this->loader->add_hook(new Localization());
            $this->loader->add_hook(new Style('admin'));
            $this->loader->add_hook(new Script('admin'));
            $this->loader->add_hook(new Style('public'));
            $this->loader->add_hook(new Script('public'));
        } catch (\Exception $error) {
            Log::error('could not add hooks', ['exception' => $error]);
        }
    }

    public function run(): void {
        try {
            $this->loader->run();
        } catch (\Exception $error) {
            Log::error('could not run plugin', ['exception' => $error]);
        }
    }

    public static function activate(): void {
        Log::info('Plugin Activated');
    }

    public static function deactivate(): void {
        Log::info('Plugin Deactivated');
    }

    public static function uninstall(): void {
        Log::info('The Tower of Babel has fallen');
    }

    public static function base_dir(): string {
        return Path::join(__DIR__, '/../../');
    }

    public static function resource_path(string ...$paths): string {
        return Path::join(self::base_dir(), ...$paths);
    }
}