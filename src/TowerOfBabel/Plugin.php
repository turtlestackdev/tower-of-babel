<?php


namespace TowerOfBabel;


use Exception;
use Symfony\Component\Filesystem\Path;
use TowerOfBabel\Hooks\HookArea;
use TowerOfBabel\Hooks\HookRegistry;
use TowerOfBabel\Hooks\Localization;
use TowerOfBabel\Hooks\Script;
use TowerOfBabel\Hooks\Settings\AdminForm;
use TowerOfBabel\Hooks\Settings\Settings;
use TowerOfBabel\Hooks\Style;
use TowerOfBabel\Utilities\Log;

class Plugin {
    const NAME = 'tower-of-babel';
    const VERSION = '0.1.0';
    protected HookRegistry $hooks;
    protected Settings $settings;
    protected static string $base_dir;
    protected static string $web_path;

    public function __construct() {
        $this->add_settings();
        $this->register_hooks();
    }

    protected function add_settings(): void {
        $this->settings = new Settings();
        $this->settings->add_form(new AdminForm());
    }

    protected function register_hooks(): void {
        try {
            $this->hooks = new HookRegistry();
            $this->hooks->add_hook(new Localization());
            $this->hooks->add_hook(new Style(HookArea::Admin));
            $this->hooks->add_hook(new Script(HookArea::Admin));
            $this->hooks->add_hook(new Style(HookArea::Public));
            $this->hooks->add_hook(new Script(HookArea::Public));

            // The settings themselves and the menus are registered under different hooks,
            // but they need to be tightly coupled to avoid building UIs through echo statements.
            $this->hooks->add_hook($this->settings);
            foreach ($this->settings->get_forms() as $form) {
                $this->hooks->add_hook($form);
            }

        } catch (Exception $error) {
            Log::error('could not register hooks', ['exception' => $error]);
        }
    }

    public function run(): void {
        try {
            $this->hooks->run();
        } catch (Exception $error) {
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

    public static function set_base_dir(string $dir): void {
        static::$base_dir = $dir;
    }

    public static function base_dir(): string {
        return static::$base_dir;
    }

    public static function resource_path(string ...$paths): string {
        return Path::join(static::$base_dir, ...$paths);
    }

    public static function set_web_path(string $path): void {
        static::$web_path = $path;
    }

    public static function web_path(string ...$paths): string {
        // This won't work if running on Windows.
        return Path::join(static::$web_path, ...$paths);
    }
}