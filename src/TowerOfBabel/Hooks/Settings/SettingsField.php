<?php


namespace TowerOfBabel\Hooks\Settings;


class SettingsField {
    public string $id;
    public string $label;
    public FieldType $type = FieldType::Text;
    public string $placeholder = '';
    public string $prompt = '';
    public string|array $value = '';
    public string $default_value = '';
    public array $choices = [];
    public bool $required = false;
    public bool $sensitive = false;
    public array $errors = [];
    public array $validation_rules = [];

    public function __construct(
        string       $id,
        string       $label,
        FieldType    $type = FieldType::Text,
        string       $placeholder = '',
        string       $prompt = '',
        array|string $value = '',
        string       $default_value = '',
        array        $choices = [],
        bool         $required = false,
        bool         $sensitive = false,
        array        $validation_rules = []
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->prompt = $prompt;
        $this->value = $value;
        $this->default_value = $default_value;
        $this->choices = $choices;
        $this->required = $required;
        $this->sensitive = $sensitive;
        $this->validation_rules = $validation_rules;
    }
}