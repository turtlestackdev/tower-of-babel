<?php


namespace TowerOfBabel\Hooks;


use TowerOfBabel\Hooks\Settings\SettingsMenu;

class AdminInit extends Hook {


    function get_type(): HookType {
        return HookType::Action;
    }

    public function get_hook_name(): string {
        return 'admin_init';
    }

    protected function callback(): void {
        $this->configure_settings();
    }

    private function configure_settings(): void {
        register_setting(SettingsMenu::SLUG, 'tower-of-babel-admin-options');
        add_settings_section('tower-of-babel-slack-settings', 'Slack Integration');
    }
}