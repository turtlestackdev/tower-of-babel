<?php


namespace TowerOfBabel\Hooks\Settings;

use TowerOfBabel\Hooks\Hook;
use TowerOfBabel\Hooks\HookType;
use TowerOfBabel\Templates\Template;

/**
 * The Settings Menu is created as a property of a SettingsForm.
 * The Setting Menu determines where in the WordPress navigation the link to the SettingsForm is placed.
 * The SettingsForm manages the data and form inputs
 *
 * For more info on the Menu settings see:
 * https://developer.wordpress.org/plugins/administration-menus/top-level-menus/
 * https://developer.wordpress.org/reference/functions/add_menu_page/
 *
 * https://developer.wordpress.org/plugins/administration-menus/sub-menus/
 * https://developer.wordpress.org/reference/functions/add_submenu_page/
 */
class SettingsMenu extends Hook {
    public ?string $parent_menu = null;
    public string $page_title;
    public string $menu_title;
    public string $slug;
    const SLUG = 'tower-of-babel-settings';

    public function __construct(string $page_title, string $menu_title, string $slug, ?ParentMenu $parent_menu = null, ?string $custom_type = null) {
        $this->parent_menu = $parent_menu?->slug($custom_type);
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->slug = $slug;
    }

    function get_type(): HookType {
        return HookType::Action;
    }

    public function get_id(): string {
        // admin_menu is the hook name defined by WordPress needed to add this as a menu item.
        return 'admin_menu';
    }

    protected function callback(): void {
        // this callback function is called when the admin_menu hook is triggered
        if($this->parent_menu == null) {
            // if no parent menu is defined, we add this as a top level menu
            add_menu_page(
                $this->page_title,
                $this->menu_title,
                'manage_options',
                $this->slug,
                [$this, 'render_form']
            );
        } else {
            // otherwise we add it as the submenu of the parent, e.g., plugins.php
            add_submenu_page(
                $this->parent_menu,
                $this->page_title,
                $this->menu_title,
                'manage_options',
                $this->slug,
                [$this, 'render_form']
            );
        }
    }

    public function render_form(): void {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
        Template::load('settings');
    }
}