<?php


namespace TowerOfBabel\Hooks\Settings;


class SettingsField {
    public string $id;
    public string $label;
    public array $args;

    public function __construct(string $name, string $label, array $args = [], array $class = []) {
        $this->id = $name;
        $this->label = $label;
        $this->args = $args;
        $this->args['label_for'] = $this->id;
        $this->args['class'] = implode(', ', $class);
    }
}