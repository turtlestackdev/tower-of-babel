<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://turtlestack.dev
 * @since             0.1.0
 * @package           Tower_Of_Babel
 *
 * @wordpress-plugin
 * Plugin Name:       Tower of Babel
 * Plugin URI:        https://github.com/turtlestackdev/tower-of-babel.git
 * Description:       A plugin designed to facilitate the translation of posts and MailChimp email campaigns.
 * Version:           0.1.0
 * Author:            Shane Scanlon
 * Author URI:        https://turtlestack.dev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tower-of-babel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
const TOWER_OF_BABEL_VERSION = '0.1.0';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tower-of-babel-activator.php
 */
function activate_tower_of_babel() : void {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tower-of-babel-activator.php';
	Tower_Of_Babel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tower-of-babel-deactivator.php
 */
function deactivate_tower_of_babel() : void {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tower-of-babel-deactivator.php';
	Tower_Of_Babel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tower_of_babel' );
register_deactivation_hook( __FILE__, 'deactivate_tower_of_babel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tower-of-babel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_tower_of_babel() : void {

	$plugin = new Tower_Of_Babel();
	$plugin->run();

}
run_tower_of_babel();
