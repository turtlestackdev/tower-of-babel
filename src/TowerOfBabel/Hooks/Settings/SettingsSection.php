<?php


namespace TowerOfBabel\Hooks\Settings;


abstract class SettingsSection {
    abstract public function get_id(): string;

    abstract public function get_title(): string;

    /** @return array<SettingsField> */
    abstract public function get_fields(): array;

    public function register_fields(string $page): void {
        foreach ($this->get_fields() as $field) {
            add_settings_field($field->id, $field->label, [$this, 'noop'], $page, $this->get_id(), $field->args);
        }
    }

    public function noop(): void {
        // The WordPress settings system requires a callback.
        // This callback is expected to echo out to the browser.
        // I am dumbfounded by this design.
        // All our fields will be compiled and rendered via the Hooks\Settings::render_form function.
        // This function serves as the callback for WP.
    }
}