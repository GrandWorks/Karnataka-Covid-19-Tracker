<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://grandworks.co
 * @since             1.0.0
 * @package           Karnataka_covid
 *
 * @wordpress-plugin
 * Plugin Name:       Karnataka COVID 19 tracker
 * Plugin URI:        https://grandworks.co
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            GrandWorks
 * Author URI:        https://grandworks.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       karnataka_covid
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'KARNATAKA_COVID_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-karnataka_covid-activator.php
 */
function activate_karnataka_covid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-karnataka_covid-activator.php';
	Karnataka_covid_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-karnataka_covid-deactivator.php
 */
function deactivate_karnataka_covid() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-karnataka_covid-deactivator.php';
	Karnataka_covid_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_karnataka_covid' );
register_deactivation_hook( __FILE__, 'deactivate_karnataka_covid' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-karnataka_covid.php';

/**
 * 
 * Include table generator
 */

require plugin_dir_path( __FILE__ ) . 'includes/display-table.php';

/**
 * Include updater
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/Updater-class.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_karnataka_covid() {

	
	if ( is_admin() ) {
		new BFIGitHubPluginUpdater( __FILE__, 'myGitHubUsername', "Repo-Name" );
	}
	function display_table( $atts ){
		return generate_table();
	}
	add_shortcode( 'karnataka_covid_tracker', 'display_table' );

	$plugin = new Karnataka_covid();
	$plugin->run();

}
run_karnataka_covid();
