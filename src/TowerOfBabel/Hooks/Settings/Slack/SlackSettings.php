<?php


namespace TowerOfBabel\Hooks\Settings\Slack;


use TowerOfBabel\Hooks\Settings\SettingsField;
use TowerOfBabel\Hooks\Settings\SettingsSection;
use TowerOfBabel\Templates\Template;

class SlackSettings extends SettingsSection {
    /** @var SettingsField[] $fields */
    public array $fields = [];

    public function __construct() {
        $api_key = new SettingsField(
            'tower-of-babel-slack-api-key',
            'API Key'
        );
        $api_key->sensitive = true;

        $this->fields[] = $api_key;
    }


    public function get_id(): string {
        return 'tower-of-babel-slack-settings';
    }

    public function get_title(): string {
        return 'Slack';
    }

    public function get_fields(): array {
        return $this->fields;
    }

    protected function callback(): void {
        Template::load('slack/admin-form-header');
    }
}