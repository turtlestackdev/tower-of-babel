<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <h2><?= $data['name'] ?? 'EMPTY' ?></h2>
    <form action="<?php menu_page_url( 'tower-of-babel-settings' ) ?>" method="post">
        <?php
        // output security fields for the registered setting "wporg_options"
        settings_fields('wporg_options');
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections('wporg');
        // output save settings button
        submit_button(__('Save Settings', 'textdomain'));
        ?>
    </form>
</div>