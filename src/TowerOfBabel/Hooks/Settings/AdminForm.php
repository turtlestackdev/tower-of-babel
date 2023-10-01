<?php


namespace TowerOfBabel\Hooks\Settings;

use TowerOfBabel\Hooks\Settings\Slack\SlackSettings;

class AdminForm extends SettingsForm {
    /** @var SettingsSection[] $sections */
    public array $sections = [];

    public function __construct() {
        $this->sections[] = new SlackSettings();
    }


    public function get_id(): string {
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
        return $this->sections;
    }
}