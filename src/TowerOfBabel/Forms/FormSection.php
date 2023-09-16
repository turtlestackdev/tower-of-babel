<?php


namespace TowerOfBabel\Forms;


class FormSection {

    public string $id;
    public string $label;
    /** @var array<FormField>  */
    public array $fields = [];

    public function get_props(): array {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'fields' => $this->get_field_props()
        ];
    }

    public function get_field_props(): array {
        $props = [];
        foreach ($this->fields as $field) {
            $props[] = $field->get_props();
        }
        return $props;
    }
}