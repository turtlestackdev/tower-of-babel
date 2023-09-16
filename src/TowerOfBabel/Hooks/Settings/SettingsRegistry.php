<?php


namespace TowerOfBabel\Hooks\Settings;


class SettingsRegistry {
    /** @var array<SettingsGroup> */
    private array $groups = [];

    public function add_setting(SettingsGroup $setting): void {
        $this->groups[] = $setting;
    }

    /** @return  array<SettingsGroup> */
    public function get_settings(): array {
        return $this->groups;
    }

    public function register_settings(): void {
        foreach ($this->groups as $group) {
            $this->register_setting($group);
        }
    }

    private function register_setting(SettingsGroup $group): void {
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