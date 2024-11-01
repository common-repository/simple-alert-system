<?php

// Add open-body function if it doesn't exist
class sas_check_ob_hook {
  public function __construct() {
    $this->sas_check_hook();
  }
  public function sas_check_hook() {
    if ( !function_exists( 'wp_body_open' ) ) {
      function wp_body_open() {
        do_action( 'wp_body_open' );
      }

    }
  }

}

new sas_check_ob_hook();

// Initiate SAS Alert
class sas_add_alert {
  public function __construct() {
    add_action( 'wp_body_open', array( $this, 'sas_pull_alert' ) );
  }

  function sas_pull_alert() {
    include( "alert.php" );
  }

}


$sas_add_alert = new sas_add_alert();

/* Register and include Simple Alert Systemsasset  assets */
class sas_add_assets {
  public function __construct() {

    add_action( 'admin_enqueue_scripts', array( $this, 'sas_enqueue_assets' ) );

  }

  public function sas_enqueue_assets() {
    // Custom CSS
    wp_enqueue_style( 'sas-style', plugins_url( '/assets/styles/sas-settings-style.css', __FILE__ ) );

    // Material Icons
    wp_enqueue_style( 'material-icons', '//fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp' );

    // jQuery U.I CSS
    wp_enqueue_style( 'jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );


    // jQuery U.I JS
    wp_enqueue_script( 'jquery-ui-js', '//code.jquery.com/ui/1.12.1/jquery-ui.js' );

  }

}

$enqueue_assets = new sas_add_assets();

// Simple Alert System menu

class sas_add_menu {

  public function __construct() {

    add_action( 'admin_menu', array( $this, 'sas_register_menu' ) );

  }


  public function sas_register_menu() {

    add_menu_page(

      __( 'Alert System', 'simple-alert-system' ),

      'Alert System',

      'manage_options',

      '/options-general.php?page=simple-alert-system',

      '',

      plugins_url( '/simple-alert-system/img/notification.png' ), 999 );

  }

}


new sas_add_menu();


// Load text domain
class sas_text_domain {

  public function __construct() {

    add_action( 'plugins_loaded', array( $this, 'sas_load_text_domain' ) );

  }


  public function sas_load_text_domain() {

    load_plugin_textdomain( 'sas_load_text_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

  }


}

new sas_text_domain();


// Include settings page
include( "controls/sas-settings.php" );