<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 */
class Tower_Of_Babel {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     */
    protected Tower_Of_Babel_Loader $loader;
    protected string $plugin_name = 'tower-of-babel';
    protected string $version = '0.1.0';
    protected Logger $logger;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if (defined('TOWER_OF_BABEL_VERSION')) {
            $this->version = TOWER_OF_BABEL_VERSION;
        }

        $this->logger = new Logger('TOWER-OF-BABEL');
        $this->logger->pushHandler(new StreamHandler(PLUGIN_ROOT_PATH.'tower-of-babel.log', Logger::INFO));

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }


    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Tower_Of_Babel_Loader. Orchestrates the hooks of the plugin.
     * - Tower_Of_Babel_i18n. Defines internationalization functionality.
     * - Tower_Of_Babel_Admin. Defines all hooks for the admin area.
     * - Tower_Of_Babel_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     */
    private function load_dependencies(): void {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-tower-of-babel-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-tower-of-babel-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-tower-of-babel-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'public/class-tower-of-babel-public.php';

        $this->loader = new Tower_Of_Babel_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Tower_Of_Babel_i18n class in order to set the domain and to register the hook
     * with WordPress.
     */
    private function set_locale(): void {
        $plugin_i18n = new Tower_Of_Babel_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all the hooks related to the admin area functionality
     * of the plugin.
     */
    private function define_admin_hooks(): void {
        $plugin_admin = new Tower_Of_Babel_Admin($this->plugin_name, $this->version, $this->logger);
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all the hooks related to the public-facing functionality
     * of the plugin.
     */
    private function define_public_hooks(): void {
        $plugin_public = new Tower_Of_Babel_Public($this->plugin_name, $this->version, $this->logger);
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all the hooks with WordPress.
     */
    public function run(): void {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     */
    public function get_plugin_name(): string {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     */
    public function get_loader(): Tower_Of_Babel_Loader {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     */
    public function get_version(): string {
        return $this->version;
    }
}
