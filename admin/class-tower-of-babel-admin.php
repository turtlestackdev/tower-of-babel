<?php

use Monolog\Logger;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 */
class Tower_Of_Babel_Admin {
    private string $plugin_name;
    private string $version;
    private Logger $logger;

    /**
     * Initialize the class and set its properties.
     */
    public function __construct(string $plugin_name, string $version, Logger $logger) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->logger = $logger;
    }

    /**
     * Register the stylesheets for the admin area.
     */
    public function enqueue_styles(): void {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Tower_Of_Babel_Loader as all the hooks are defined
         * in that particular class.
         *
         * The Tower_Of_Babel_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'css/tower-of-babel-admin.css',
            [],
            $this->version
        );
    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function enqueue_scripts(): void {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Tower_Of_Babel_Loader as all the hooks are defined
         * in that particular class.
         *
         * The Tower_Of_Babel_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'js/tower-of-babel-admin.js',
            [],
            $this->version,
            true
        );
    }
}
