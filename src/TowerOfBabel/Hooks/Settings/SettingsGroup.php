<?php


namespace TowerOfBabel\Hooks\Settings;


use TowerOfBabel\Hooks\HookType;

abstract class SettingsGroup {
    public SettingsMenu $menu;

    public function __construct() {
        $this->menu = new SettingsMenu(
            $this->get_page_title(),
            $this->get_menu_title(),
            $this->get_slug(),
            $this->get_parent_menu(),
            $this->get_custom_type(),
        );
    }

    public function get_menu() : SettingsMenu {
        return $this->menu;
    }

    public function get_options_name(): string {
        return $this->get_name().'-options';
    }

    abstract function get_name(): string;

    abstract function get_parent_menu(): ?ParentMenu;

    /**
     * convenience method in case this belongs to a custom post type
     * will likely never need to be implemented to just returning null as the default.
     * override in child classes if needed.
     */
    public function get_custom_type() : ?string {
        return null;
    }

    abstract function get_page_title(): string;

    abstract function get_menu_title(): string;

    abstract function get_slug(): string;


    /**
     * @return array<SettingsSection>
     */
    abstract function get_sections(): array;
}