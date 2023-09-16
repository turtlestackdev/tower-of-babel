<?php

namespace TowerOfBabel\Hooks\Settings;

enum ParentMenu: string {
    case Dashboard = 'index.php';
    case Posts = 'edit.php';
    case Media = 'upload.php';
    case Pages = 'edit.php?post_type=page';
    case Comments = 'edit-comments.php';
    case Appearance = 'themes.php';
    case Plugins = 'plugins.php';
    case Users = 'users.php';
    case Tools = 'tools.php';
    case Settings = 'options-general.php';
    case NetWorkSettings = 'settings.php';
    // this one needs to be appended with the custom type through the slug() method
    case CustomPost = 'edit.php?post_type=';

    public function slug(?string $custom_type = null): string {
        if($this == ParentMenu::CustomPost) {
            if($custom_type == null) {
                throw new \InvalidArgumentException('custom post type not defined');
            }

            return $this->value.$custom_type;
        }

        return $this->value;
    }
}
