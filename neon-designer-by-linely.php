<?php
/**
 * Plugin Name: Neon Designer by Linely
 * Plugin URI: http://example.com/neon-designer-by-linely
 * Description: Prosta wtyczka do projektowania neonów z panelem zarządzania w WP-ADMIN.
 * Version: 1.0
 * Author: Linely
 * Author URI: http://example.com
 * Text Domain: neon-designer-by-linely
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NEON_DESIGNER_VERSION', '1.0' );

/**
 * Aktywacja wtyczki.
 */
function activate_neon_designer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neon-designer-activator.php';
	Neon_Designer_Activator::activate();
}

/**
 * Deaktywacja wtyczki.
 */
function deactivate_neon_designer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-neon-designer-deactivator.php';
	Neon_Designer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_neon_designer' );
register_deactivation_hook( __FILE__, 'deactivate_neon_designer' );

/**
 * Główna klasa wtyczki.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-neon-designer.php';

/**
 * Rozpoczęcie działania wtyczki.
 */
function run_neon_designer() {
	$plugin = new Neon_Designer();
	$plugin->run();
}

run_neon_designer();
