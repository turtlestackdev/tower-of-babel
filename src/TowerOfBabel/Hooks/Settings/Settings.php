<?php


namespace TowerOfBabel\Hooks\Settings;


use TowerOfBabel\Hooks\Hook;
use TowerOfBabel\Hooks\HookType;

class Settings extends Hook {
    /** @var SettingsForm[] */
    public array $forms = [];


    public function get_id(): string {
        return 'admin_init';
    }

    function get_type(): HookType {
        return HookType::Action;
    }

    public function add_form(SettingsForm $setting): void {
        $this->forms[] = $setting;
    }

    /** @return  SettingsForm[] */
    public function get_forms(): array {
        return $this->forms;
    }

    protected function callback(): void {
        foreach ($this->forms as $form) {
            $this->register_setting($form);
        }
    }

    protected function register_setting(SettingsForm $form): void {
        register_setting($form->get_name(), $form->get_options_name());
        foreach ($form->get_sections() as $section) {
            add_settings_section(
                $section->get_id(),
                $section->get_title(),
                [$section, 'callback_wrapper'],
                $form->get_name()
            );

            foreach($section->get_fields() as $field) {
                add_settings_field(
                    $field->id,
                    $field->label,
                    [$this, 'noop'],
                    $form->get_id(),
                    $section->get_id(),
                    $field->args);
            }
        }
    }

    private function noop(): void {
        // The WordPress settings system requires a callback.
        // This callback is expected to echo out to the browser.
        // I am dumbfounded by this design.
        // All our fields will be compiled and rendered via the Hooks\SettingsForm::render_form function.
        // This function serves as the callback for WP.
    }
}