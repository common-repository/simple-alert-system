<?php
/**

 * Plugin Name: Simple Alert System

 * Plugin URI: https://seopyramid.io/

 * Description: Simplified website alert system for WordPress.

 * Version: 1.2.0 

 * Author: Chibueze Okechukwu

 * Author URI: https://chibuezeokechukwu.com

 * Text Domain: simple-alert-system 

 * Domain Path: /languages/


 **/


// Include the functions file

include( "classes.php" );

// Add settings link
function sas_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=simple-alert-system">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'sas_add_settings_link' );