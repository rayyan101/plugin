<?php 

/**
 * Plugin Name:       RJ Plugin
 * Description:       Experiment Plugin
 * Version:           1.0
 * Author:            Rayyan Jamil
 * Author URI:        https://facebook.com
 * License:           GPL v2 or later
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'CPF_PLUGIN_DIR' ) ) {
	define( 'CPF_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'CPF_PLUGIN_DIR_URL' ) ) {
	define( 'CPF_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'CPF_ABSPATH' ) ) {
	define( 'CPF_ABSPATH', dirname( __FILE__ ) );
}


	include_once CPF_ABSPATH . '/includes/class-CFP-loader.php';




?>