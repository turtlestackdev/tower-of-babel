<?php


namespace TowerOfBabel\Hooks\Settings;


abstract class SettingsSection {
    abstract public function get_id(): string;

    abstract public function get_title(): string;

    /** @return SettingsField[] */
    abstract public function get_fields(): array;
}