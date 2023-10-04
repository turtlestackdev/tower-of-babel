<?php


namespace TowerOfBabel\Hooks\Settings;


use TowerOfBabel\Hooks\Hook;
use TowerOfBabel\Hooks\HookType;
use TowerOfBabel\Templates\Template;
use TowerOfBabel\Utilities\Log;
use Symfony\Component\HttpFoundation\Request;


abstract class SettingsForm extends Hook {
    function get_type(): HookType {
        return HookType::Action;
    }

    public function get_hook_name(): string {
        // admin_menu is the hook name defined by WordPress needed to add this as a menu item.
        return 'admin_menu';
    }

    public function get_action(): string {
        return menu_page_url($this->get_id());
    }

    protected function callback(): void {
        // this callback function is called when the admin_menu hook is triggered
        $parent_menu_slug = $this->get_parent_menu()?->slug($this->get_custom_type());
        if ($parent_menu_slug == null) {
            // if no parent menu is defined, we add this as a top level menu
            $hookname = add_menu_page(
                $this->get_page_title(),
                $this->get_menu_title(),
                'manage_options',
                $this->get_hook_name(),
                [$this, 'render_form']
            );
            add_action('load-'.$hookname, [$this, 'handle_submit']);
        } else {
            // otherwise we add it as the submenu of the parent, e.g., plugins.php
            $hookname = add_submenu_page(
                $parent_menu_slug,
                $this->get_page_title(),
                $this->get_menu_title(),
                'manage_options',
                $this->get_hook_name(),
                [$this, 'render_form']
            );
            add_action('load-'.$hookname, [$this, 'handle_page_load']);
        }
    }

    public function render_form(): void {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        Template::load('settings', $this);
    }

    public function handle_page_load(): void {
        $request = Request::createFromGlobals();
        if ($request->getMethod() == Request::METHOD_POST) {
            $this->handle_submit($request);
        }
    }

    protected function handle_submit(Request $request): void {
        Log::info("form submitted", ['args' => $request]);
    }

    public function get_options_name(): string {
        return $this->get_id().'-options';
    }

    abstract function get_id(): string;

    abstract function get_parent_menu(): ?ParentMenu;

    /**
     * convenience method in case this belongs to a custom post type
     * will likely never need to be implemented to just returning null as the default.
     * override in child classes if needed.
     */
    public function get_custom_type(): ?string {
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