<?php


namespace TowerOfBabel\Hooks\Settings\Slack;


use TowerOfBabel\Hooks\Settings\SettingsField;
use TowerOfBabel\Hooks\Settings\SettingsSection;
use TowerOfBabel\Templates\Template;

class SlackSettings extends SettingsSection {


    public function get_id(): string {
        return 'tower-of-babel-slack-settings';
    }

    public function get_title(): string {
        return 'Integrate Slack';
    }

    public function get_fields(): array {
        return [
            new SettingsField(
                'tower-of-babel-slack-api-key',
                'API Key'
            ),
        ];
    }

    protected function callback(): void {
        Template::load('slack/admin-form-header');
    }
}