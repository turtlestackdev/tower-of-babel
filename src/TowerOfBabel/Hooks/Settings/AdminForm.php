<?php


namespace TowerOfBabel\Hooks\Settings;

use TowerOfBabel\Hooks\Settings\Slack\SlackSettings;

class AdminForm extends SettingsForm {
    public function get_name(): string {
        return 'tower-of-babel-admin-settings';
    }

    function get_parent_menu(): ParentMenu {
        return ParentMenu::Plugins;
    }

    function get_page_title(): string {
        return 'Tower of Babel Settings';
    }

    function get_menu_title(): string {
        return 'Tower of Babel';
    }

    function get_slug(): string {
        return 'tower-of-babel-settings';
    }

    /**
     * @inheritDoc
     */
    public function get_sections(): array {
        $slack = new SlackSettings();

        return [$slack];
    }
}