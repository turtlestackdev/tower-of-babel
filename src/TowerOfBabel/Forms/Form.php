<?php


namespace TowerOfBabel\Forms;


use TowerOfBabel\Hooks\Settings\SettingsForm;
use TowerOfBabel\Templates\Template;

class Form {
    public string $id;
    public string $label;
    public string $action = 'options.php';
    /** @var array<FormSection> */
    public array $form_sections = [];

    public function __construct(SettingsForm $settings) {
        $this->id = $settings->get_name();
        $this->label = $settings->get_options_name();
        foreach ($settings->get_sections() as $section) {
            $this->form_sections = new FormSection($section);
        }
    }


    protected function get_props(): array {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'action' => $this->action,
            'sections' => $this->get_form_section_props(),
        ];
    }

    protected function get_form_section_props(): array {
        $props = [];
        foreach ($this->form_sections as $section) {
            $props[] = $section->get_props();
        }

        return $props;
    }

    public function render(): void {
        $props = $this->get_props();
        Template::load('form');
    }
}