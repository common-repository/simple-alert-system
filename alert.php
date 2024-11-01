<?php

// Define varibale 
$bgcolor = $simple_alert_system_options = $setColor = $ftColor = $alert_link = $sas_schedule_start_date = $sas_schedule_end_date = $today = $run_sas_alert = $ctaBg = $ctaftColor = $post_slug = $scopeArray = $selected = $scopeRange = $pageInclusive = $sas_active_theme = $ctaValue = $publicDisplay = "";

$simple_alert_system_options = get_option( 'simple_alert_system_option_name' );

// Breakk down schedule dates 
if ( !empty( $simple_alert_system_options[ 'sas_schedule' ] ) ) {
  $perDate = explode( " ", $simple_alert_system_options[ 'sas_schedule' ] );
  $sas_schedule_start_date = date_format( new DateTime( $perDate[ 0 ] ), 'm/d/Y' );
  $sas_schedule_end_date = date_format( new DateTime( $perDate[ 1 ] ), 'm/d/Y' );
  $today = date_format( new DateTime(), 'm/d/Y' );

  if ( $sas_schedule_start_date <= $today && $sas_schedule_end_date >= $today ) {
    $run_sas_alert = "yes";
  }

}

// Check if alert should display on current page
$post_slug = get_post_field( 'post_name', get_post() );

// Define slug if it is home page
if ( is_front_page() || is_home() ) {
  $post_slug = "home";
}

if ( !empty( $simple_alert_system_options[ 'sas_scope_0' ] ) ):
  $scopeArray = explode( ",", preg_replace( '/\s+/', '', $simple_alert_system_options[ 'sas_scope_0' ] ) );
$scopeRange = str_replace( ",", "", implode( ' ', $scopeArray ) );
$selected = explode( " ", "$scopeRange" );
$selected = end( $selected );
endif;

if ( $selected === "1" ) {

  // Show where currnet page is not in $scopeArray
  if ( !in_array( $post_slug, $scopeArray ) ) {
    $pageInclusive = "YES";
  }

} elseif ( $selected === "2" ) {

  // Show where current page slug is in $scopeArray
  if ( in_array( $post_slug, $scopeArray ) ) {
    $pageInclusive = "YES";
  }

} else {
  $pageInclusive = "YES";
}


if ( is_array( $simple_alert_system_options ) &&
  !empty( $simple_alert_system_options[ 'enable_alert' ] ) &&
  !isset( $_COOKIE[ "sas_close_alert" ] ) &&
  $run_sas_alert === "yes" &&
  $pageInclusive === "YES" ) {
  $publicDisplay = "YES";
	
  } 

 if(($publicDisplay === "YES") || is_admin())  {

  $bgcolor = $simple_alert_system_options[ 'background_0' ];

  // Run if customization is not enabled

  if ( empty( $simple_alert_system_options[ 'enable_custom' ] ) ) {

    if ( $bgcolor === "option-one" ) {

      $setColor = "#4CAF50";
      $ctaftColor = "#4CAF50!important;";
      $ftColor = "#fff!important;";

    } elseif ( $bgcolor === "option-two" ) {

      $setColor = "#21759b";
      $ctaftColor = "#21759b!important;";
      $ctaBg = "background: #fff";
      $ftColor = "#fff!important;";


    } elseif ( $bgcolor === "option-three" ) {

      $setColor = "#ffeb3b";
      $ftColor = "#000!important;";
      $ctaftColor = "#ffeb3b!important;";
      $ctaBg = "background: #000";

    } else {

      $setColor = "#ff8a80";
      $ftColor = "#fff!important;";
      $ctaftColor = "#ff8a80!important;";
      $ctaBg = "background: #fff";


    }

  

  // Define color themes' properties
  if ( !empty( $simple_alert_system_options[ 'color_mode' ] ) ) {
    $sas_active_theme = $simple_alert_system_options[ 'color_mode' ];
  }

  if ( $sas_active_theme === "light" ) {

    $ftColor = "#000!important;";

    switch ( $bgcolor ) {
      case "option-one":
        $setColor = "#ddffdd";
        $ctaftColor = "#ddffdd!important;";
        $ctaBg = "background: #000";
        break;
      case "option-two":
        $setColor = "#ddffff";
        $ctaftColor = "#ddffff!important;";
        $ctaBg = "background: #000";
        break;
      case "option-three":
        $setColor = "#ffffcc";
        $ctaftColor = "#ffffcc!important;";
        $ctaBg = "background: #000";
        break;
      default:
        $setColor = "#ffdddd";
        $ctaftColor = "#ffdddd!important;";
        $ctaBg = "background: #000";
    }

  } elseif ( $sas_active_theme === "flat" ) {

    switch ( $bgcolor ) {
      case "option-one":
        $setColor = "#1abc9c";
        $ctaftColor = "#1abc9c!important;";
        $ctaBg = "background: #000";
        $ftColor = "#000!important;";
        break;
      case "option-two":
        $setColor = "#3498db";
        $ctaftColor = "#3498db!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
        break;
      case "option-three":
        $setColor = "#f1c40f";
        $ctaftColor = "#f1c40f!important;";
        $ctaBg = "background: #000";
        $ftColor = "#000!important;";
        break;
      default:
        $setColor = "#e74c3c";
        $ftColor = "#fff!important;";
        $ctaftColor = "#e74c3c!important;";
        $ctaBg = "background: #fff";
    }

  } elseif ( $sas_active_theme === "material" ) {

    switch ( $bgcolor ) {
      case "option-one":
        $setColor = "#66BB6A";
        $ctaftColor = "#66BB6A!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
        break;
      case "option-two":
        $setColor = "#40C4FF";
        $ctaftColor = "#40C4FF!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
        break;
      case "option-three":
        $setColor = "#FFD600";
        $ctaftColor = "#FFD600!important;";
        $ctaBg = "background: #000";
        $ftColor = "#000!important;";
        break;
      default:
        $setColor = "#ff8a80";
        $ftColor = "#fff!important;";
        $ctaftColor = "#ff8a80!important;";
        $ctaBg = "background: #fff";
    }

  } elseif ( $sas_active_theme === "social" ) {

    switch ( $bgcolor ) {
      case "option-one":
        $setColor = "#25D366";
        $ctaftColor = "#25D366!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
        break;
      case "option-two":
        $setColor = "#21759b";
        $ctaftColor = "#21759b!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
        break;
      case "option-three":
        $setColor = "#FFFC00";
        $ctaftColor = "#FFFC00!important;";
        $ctaBg = "background: #000";
        $ftColor = "#000!important;";
        break;
      default:
        $setColor = "#ff5700";
        $ftColor = "#fff!important;";
        $ctaftColor = "#ff5700!important;";
        $ctaBg = "background: #fff";
    }

  } else {

    switch ( $bgcolor ) {
      case "option-one":
        $setColor = "#4CAF50";
        $ctaftColor = "#4CAF50!important;";
        $ftColor = "#fff!important;";
        break;
      case "option-two":
        $setColor = "#21759b";
        $ctaftColor = "#21759b!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
        break;
      case "option-three":
        $setColor = "#ffeb3b";
        $ftColor = "#000!important;";
        $ctaftColor = "#ffeb3b!important;";
        $ctaBg = "background: #000";
        break;
      default:
        $setColor = "#f44336";
        $ctaftColor = "#f44336!important;";
        $ctaftColor = "#ff5700!important;";
        $ctaBg = "background: #fff";
        $ftColor = "#fff!important;";
    }

  }
	  
	  } else {

    $setColor = $simple_alert_system_options[ 'bgColor' ];

    $ftColor = $simple_alert_system_options[ 'fontColor' ] . "!important";

  }


  // Contruct alert link

  $simple_alert_system_options = get_option( 'simple_alert_system_option_name' );

  $sas_alert_link = $simple_alert_system_options[ 'link' ];

  $sas_alert_link_target = $simple_alert_system_options[ 'link_target_0' ];

  $alert_link = 'href="' . esc_url( $sas_alert_link ) . '"' . ' target="' . esc_attr( $sas_alert_link_target ) . '"';


  // Load jQuery is site doe not have one

  if ( !wp_script_is( 'jquery' ) ) {

    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

  }

  ?>
<div id="simple-alert-system"> 
  
  <!-- Alert Control System --> 
  
  <script>


  // Wait for document to be ready

  jQuery(function(){

    jQuery("#simple-alert-system .close-alert").click(function () { 
 
       // Define clicked item

       var closeAlert = "closeAlert";

         jQuery.ajax({        

		         type: "GET",   

                 url: "<?php echo plugin_dir_url( __FILE__ ) . "controls/sas-controls.php" ?>",  

                 async: false,

				 dataType: "html",

				 data: ({

				 closeAlert: closeAlert, 

                 }),	 

                 success : function(text) {  

                     jQuery("#simple-alert-system").slideUp(100);     

                     }

           });	  

});     


  });



</script> 
  
  <!-- Load Style -->
  
  <style>

	<?php

	include("assets/styles/style.css");

    /* Alert color code starts here */
	 
	?>

    #simple-alert-system {

        background: <?php echo $setColor ?>;

        color: <?php echo $ftColor?>

        }

       #simple-alert-system .alert-box, #simple-alert-system .close-alert {

      color: <?php echo $ftColor?>

     }  
	  
	 #simple-alert-system .sas_cta {
	 color: <?php echo $ctaftColor . ";" . $ctaBg; ?>
	  }
	  
	 <?php
	// Implement user CTA style option
	if(!empty($simple_alert_system_options['sas_cta'])):
	$ctaValue = explode( ' ', $simple_alert_system_options['sas_cta']);
    $ctaValue = end($ctaValue);
	
	if($ctaValue === "border") { ?> 
	 #simple-alert-system .sas_cta {
	 border: 1px solid <?php echo $ftColor . ";" ?>;
	 background: transparent;
	 color: <?php echo $ftColor ?>;
	 opacity: 1;
	 outline: 1px solid transparent; 
	  }
		  
	<?php } endif; ?>
	  

    </style>
  <a <?php echo $alert_link ?> >
  <div class="alert-box"> <strong class="alert-title"><?php echo  esc_html($simple_alert_system_options['title']); ?></strong> <?php echo  esc_html($simple_alert_system_options['message']) ?> <br>
    <?php if(!empty(esc_html($simple_alert_system_options['sas_cta']))) { ?>
    <div class="sas_cta"><?php echo  esc_html(preg_replace('/\W\w+\s*(\W*)$/', '$1', $simple_alert_system_options['sas_cta'])); ?></div>
    <?php } ?>
  </div>
  <!-- End alert box --> 
  
  </a><!-- End alert link --> 
  
  <!-- End Alert box -->
  
  <div class="close-alert"><i class="material-icons">close</i></div>
</div>

<!-- End Alert -->

<?php } ?>
