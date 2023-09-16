<?php


namespace TowerOfBabel\Forms;


class FormField {
    public string $id;
    public string $label;
    public string | array $value;
    public string $placeholder = '';
    public string $default_value = '';
    public array $choices = [];
    public FieldType $type = FieldType::Text;
}