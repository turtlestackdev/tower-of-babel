<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://turtlestack.dev
 * @since      1.0.0
 *
 * @package    Tower_Of_Babel
 * @subpackage Tower_Of_Babel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class Tower_Of_Babel_i18n {
    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain(): void {
        load_plugin_textdomain(
            'tower-of-babel',
            false,
            dirname(plugin_basename(__FILE__), 2).'/languages/'
        );
    }
}
