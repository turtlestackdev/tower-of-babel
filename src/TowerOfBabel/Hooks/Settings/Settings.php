<?php


namespace TowerOfBabel\Hooks\Settings;


use TowerOfBabel\Hooks\Hook;
use TowerOfBabel\Hooks\HookType;

class Settings extends Hook {
    /** @var SettingsGroup[] */
    public array $groups = [];


    public function get_id(): string {
        return 'admin_init';
    }

    function get_type(): HookType {
        return HookType::Action;
    }

    public function add_group(SettingsGroup $setting): void {
        $this->groups[] = $setting;
    }

    /** @return  SettingsGroup[] */
    public function get_groups(): array {
        return $this->groups;
    }

    protected function callback(): void {
        foreach ($this->groups as $group) {
            $this->register_setting($group);
        }
    }

    protected function register_setting(SettingsGroup $group): void {
        register_setting($group->get_name(), $group->get_options_name());
        foreach ($group->get_sections() as $section) {
            add_settings_section(
                $section->get_id(),
                $section->get_title(),
                [$section, 'callback_wrapper'],
                $group->get_name()
            );
        }
    }
}