<?php

class SimpleAlertSystem {

  private $simple_alert_system_options;

  public function __construct() {

    add_action( 'admin_menu', array( $this, 'simple_alert_system_add_plugin_page' ) );

    add_action( 'admin_init', array( $this, 'simple_alert_system_page_init' ) );

  }


  public function simple_alert_system_add_plugin_page() {

    add_options_page(

      'Simple Alert System', // page_title

      'Simple Alert System', // menu_title

      'manage_options', // capability/level

      'simple-alert-system', // menu_slug

      array( $this, 'simple_alert_system_create_admin_page' ) // function

    );

  }


  public function simple_alert_system_create_admin_page() {

    $this->simple_alert_system_options = get_option( 'simple_alert_system_option_name' );

    ?>
<div class="simple_alert_system">
  <style>
	
	#wpcontent {
background: #fff!important;	
}
	  
	  .sas_cta {
		opacity: 1!important;
		transition: all 0s!important
	  }
	  
	  #simple-alert-system {
	  transition: all 0.7s;
	  }
	
	</style>
  <h1 class="sas_title">Simple Alert System</h1>
  <script>

  // Wait for document to be ready
  jQuery(function(){
    jQuery(".switch.livePreview [type='checkbox']").on("change", function() {
		var showPreview = "showPreview";
    	  jQuery(".button.button-primary").trigger("click");
});     

  });



</script>
  <?php
  // Show alert Preview if the setting is enabled
  $simple_alert_system_options = get_option( 'simple_alert_system_option_name' );
  if ( !empty( $simple_alert_system_options[ 'enable_preview' ] ) || isset( $_COOKIE[ "sas_preview_alert" ] ) ) {
    ?>
  <div>
    <?php include(plugin_dir_path( __DIR__ ) ."alert.php") ?>
  </div>
  <?php } ?>
  <form method="post" action="options.php">
    <?php

    settings_fields( 'simple_alert_system_option_group' );

    do_settings_sections( 'simple-alert-system-admin' );

    submit_button();

    ?>
  </form>
  <?php $seo_pyramid_ready_message = 'Note: If you enable the customization section, its settings will override all default settings.'; ?>
  <div class="sas_notice">
    <?php  printf( __( '%s', 'seo-pyramid' ), $seo_pyramid_ready_message ); ?>
  </div>
  <script>
  // Instantenious Preview script	
   jQuery(function () {
   jQuery( ".first label" ).click(function() {
   var bgcolor = jQuery( this ).css( "background-color" );
   var fcolor =  jQuery( this ).css( "color" ) + "!important";
   jQuery("#simple-alert-system").css({"background": bgcolor});
   jQuery(".alert-title, .alert-box, .simple_alert_system .close-alert").attr("style", "color:" + fcolor);
   jQuery(".sas_cta").attr("style", "border: 1px solid " + fcolor + "; color:" + fcolor);
   });
	
	jQuery( "[type='color']" ).on("change", function() {
	var which = jQuery(this).attr("id");	  
	if(which === "bgColor")	 {	
	var bgcolor = jQuery(this).val();
	jQuery("#simple-alert-system").css({"background": bgcolor});
	} else {
	var fcolor =  jQuery(this).val();
	jQuery(".alert-title, .alert-box, .simple_alert_system .close-alert").attr("style", "color:" + fcolor + " !important");
    jQuery(".sas_cta").attr("style", "border: 1px solid " + fcolor + "!important; color:" + fcolor + " !important");
		
	}
		  
	});
	   
	  
	 });  
	</script> 
</div>
<?php

}


public function simple_alert_system_page_init() {

  register_setting(

    'simple_alert_system_option_group', // option_group

    'simple_alert_system_option_name', // option_name

    array( $this, 'simple_alert_system_sanitize' ) // sanitize_callback

  );


  add_settings_section(

    'simple_alert_system_setting_section', // id

    __( 'Settings', 'simple-alert-system' ), // title

    array( $this, 'simple_alert_system_section_info' ), // callback

    'simple-alert-system-admin' // page

  );


  add_settings_section(

    'simple_alert_system_setting_section1', // id

    __( 'Customize', 'simple-alert-system' ), // title

    array( $this, 'simple_alert_system_section_info' ), // callback 

    'simple-alert-system-admin' // page

  );


  add_settings_field(

    'enable_alert', // id

    __( 'Enable Alert', 'simple-alert-system' ), // title

    array( $this, 'enable_alert_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'enable_preview', // id

    __( 'Enable Preview', 'simple-alert-system' ), // title

    array( $this, 'enable_preview_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'title', // id

    __( 'Title', 'simple-alert-system' ), // title

    array( $this, 'title_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'message', // id

    __( 'Message', 'simple-alert-system' ), // title

    array( $this, 'message_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'color_mode', // id

    __( 'Color Theme', 'simple-alert-system' ), // title

    array( $this, 'color_mode_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'background_0', // id

    __( 'Background', 'simple-alert-system' ), // title

    array( $this, 'background_0_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'link', // id

    __( 'Alert Link', 'simple-alert-system' ), // title

    array( $this, 'link_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'sas_cta', // id

    __( 'Call to Action', 'simple-alert-system' ), // title

    array( $this, 'sas_cta_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'link_target_0', // id

    __( 'Link Target', 'simple-alert-system' ), // title

    array( $this, 'link_target_0_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );


  add_settings_field(

    'sas_scope_0', // id

    __( 'Show On', 'simple-alert-system' ), // title

    array( $this, 'sas_scope_0_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );

  add_settings_field(

    'sas_schedule', // id

    __( 'Alert Schedule', 'simple-alert-system' ), // title

    array( $this, 'sas_schedule_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section' // section

  );

  add_settings_field(

    'enable_custom', // id

    __( 'Enable Customization', 'simple-alert-system' ), // title

    array( $this, 'enable_custom_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section1' // section

  );


  add_settings_field(

    'bgColor', // id

    __( 'Background Color', 'simple-alert-system' ), // title

    array( $this, 'bgColor_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section1' // section

  );


  add_settings_field(

    'fontColor', // id

    __( 'Font Color', 'simple-alert-system' ), // title

    array( $this, 'fontColor_callback' ), // callback

    'simple-alert-system-admin', // page

    'simple_alert_system_setting_section1' // section

  );


}


public function simple_alert_system_sanitize( $input ) {

  $sanitary_values = array();

  if ( isset( $input[ 'title' ] ) ) {

    $sanitary_values[ 'title' ] = sanitize_text_field( $input[ 'title' ] );

  }


  if ( isset( $input[ 'sas_schedule' ] ) ) {

    $sanitary_values[ 'sas_schedule' ] = sanitize_text_field( $input[ 'sas_schedule' ] );

  }


  if ( isset( $input[ 'sas_cta' ] ) ) {

    $sanitary_values[ 'sas_cta' ] = sanitize_text_field( $input[ 'sas_cta' ] );

  }


  if ( isset( $input[ 'message' ] ) ) {

    $sanitary_values[ 'message' ] = esc_textarea( $input[ 'message' ] );

  }


  if ( isset( $input[ 'bgColor' ] ) ) {

    $sanitary_values[ 'bgColor' ] = sanitize_hex_color( $input[ 'bgColor' ] );

  }


  if ( isset( $input[ 'fontColor' ] ) ) {

    $sanitary_values[ 'fontColor' ] = sanitize_hex_color( $input[ 'fontColor' ] );

  }


  if ( isset( $input[ 'sas_scope_0' ] ) ) {

    $sanitary_values[ 'sas_scope_0' ] = $input[ 'sas_scope_0' ];

  }


  if ( isset( $input[ 'link' ] ) ) {

    $sanitary_values[ 'link' ] = sanitize_url( $input[ 'link' ] );

  }


  if ( isset( $input[ 'link_target_0' ] ) ) {

    $sanitary_values[ 'link_target_0' ] = $input[ 'link_target_0' ];

  }


  if ( isset( $input[ 'background_0' ] ) ) {

    $sanitary_values[ 'background_0' ] = $input[ 'background_0' ];

  }


  if ( isset( $input[ 'color_mode' ] ) ) {

    $sanitary_values[ 'color_mode' ] = $input[ 'color_mode' ];

  }


  if ( isset( $input[ 'enable_alert' ] ) ) {

    $sanitary_values[ 'enable_alert' ] = $input[ 'enable_alert' ];

  }


  if ( isset( $input[ 'enable_preview' ] ) ) {

    $sanitary_values[ 'enable_preview' ] = $input[ 'enable_preview' ];

  }


  if ( isset( $input[ 'enable_custom' ] ) ) {

    $sanitary_values[ 'enable_custom' ] = $input[ 'enable_custom' ];

  }


  return $sanitary_values;

}


public function simple_alert_system_section_info() {


}


public function enable_alert_callback() {


  printf(


    '<label class="switch "><input type="checkbox" name="simple_alert_system_option_name[enable_alert]" id="tenable_alert" value="enable_alert" %s><span class="slider round"></span></label>',


    ( isset( $this->simple_alert_system_options[ 'enable_alert' ] ) && $this->simple_alert_system_options[ 'enable_alert' ] === 'enable_alert' ) ? 'checked' : ''


  );


}


public function enable_preview_callback() {


  printf(


    '<label class="switch livePreview"><input type="checkbox" name="simple_alert_system_option_name[enable_preview]" id="tenable_alert" value="enable_preview" %s><span class="slider round"></span></label>',


    ( isset( $this->simple_alert_system_options[ 'enable_preview' ] ) && $this->simple_alert_system_options[ 'enable_preview' ] === 'enable_preview' ) ? 'checked' : ''


  );


}


public function title_callback() {

  printf(

    '<input class="regular-text" type="text" name="simple_alert_system_option_name[title]" id="title" value="%s" required>',

    isset( $this->simple_alert_system_options[ 'title' ] ) ? esc_attr( $this->simple_alert_system_options[ 'title' ] ) : ''

  );

}


public function message_callback() {

  printf(

    '<textarea class="large-text" rows="5" name="simple_alert_system_option_name[message]" id="message" required>%s</textarea>',

    isset( $this->simple_alert_system_options[ 'message' ] ) ? esc_attr( $this->simple_alert_system_options[ 'message' ] ) : ''

  );

}


public function background_0_callback() {

  ?>
<fieldset class="first">
  <?php $checked = ( isset( $this->simple_alert_system_options['background_0'] ) && $this->simple_alert_system_options['background_0'] === 'option-one' ) ? 'checked' : '' ; ?>
  <label for="background_0-0">
    <input type="radio" name="simple_alert_system_option_name[background_0]" id="background_0-0" value="option-one" <?php echo $checked; ?>>
    <?php _e('Green', 'simple-alert-system') ?>
  </label>
  <?php $checked = ( isset( $this->simple_alert_system_options['background_0'] ) && $this->simple_alert_system_options['background_0'] === 'option-two' ) ? 'checked' : '' ; ?>
  <label for="background_0-1">
    <input type="radio" name="simple_alert_system_option_name[background_0]" id="background_0-1" value="option-two" <?php echo $checked; ?>>
    <?php _e('Blue', 'simple-alert-system') ?>
  </label>
  <br>
  <?php $checked = ( isset( $this->simple_alert_system_options['background_0'] ) && $this->simple_alert_system_options['background_0'] === 'option-three' ) ? 'checked' : '' ; ?>
  <label for="background_0-2">
    <input type="radio" name="simple_alert_system_option_name[background_0]" id="background_0-2" value="option-three" <?php echo $checked; ?>>
    <?php _e('Yellow', 'simple-alert-system') ?>
  </label>
  <?php $checked = ( isset( $this->simple_alert_system_options['background_0'] ) && $this->simple_alert_system_options['background_0'] === 'option-four' ) ? 'checked' : '' ; ?>
  <label for="background_0-3">
    <input type="radio" name="simple_alert_system_option_name[background_0]" id="background_0-3" value="option-four" <?php echo $checked; ?>>
    <?php _e('Red', 'simple-alert-system') ?>
  </label>
</fieldset>
<?php

}


public function color_mode_callback() {
  ?>
<select name="simple_alert_system_option_name[color_mode]" id="color_mode">
  <?php $selected = (isset( $this->simple_alert_system_options['color_mode'] ) && $this->simple_alert_system_options['color_mode'] === 'light') ? 'selected' : '' ; ?>
  <option value="light" <?php echo $selected; ?>>
  <?php _e('Light Colors', 'simple-alert-system') ?>
  </option>
  <?php $selected = (isset( $this->simple_alert_system_options['color_mode'] ) && $this->simple_alert_system_options['color_mode'] === 'dark') ? 'selected' : '' ; ?>
  <option value="dark" <?php echo $selected; ?>>
  <?php _e('Dark Colors', 'simple-alert-system') ?>
  </option>
  <?php $selected = (isset( $this->simple_alert_system_options['color_mode'] ) && $this->simple_alert_system_options['color_mode'] === 'flat') ? 'selected' : '' ; ?>
  <option value="flat" <?php echo $selected; ?>>
  <?php _e('Flat Colors', 'simple-alert-system') ?>
  </option>
  <?php $selected = (isset( $this->simple_alert_system_options['color_mode'] ) && $this->simple_alert_system_options['color_mode'] === 'material') ? 'selected' : '' ; ?>
  <option value="material" <?php echo $selected; ?>>
  <?php _e('Material Colors', 'simple-alert-system') ?>
  </option>
  <?php $selected = (isset( $this->simple_alert_system_options['color_mode'] ) && $this->simple_alert_system_options['color_mode'] === 'social') ? 'selected' : '' ; ?>
  <option value="social" <?php echo $selected; ?>>
  <?php _e('Social Colors', 'simple-alert-system') ?>
  </option>
</select>
<?php

// Define color theme choice

if ( !empty( $this->simple_alert_system_options[ 'color_mode' ] ) ) {

  $theme_choice = "";

  $theme_choice = $this->simple_alert_system_options[ 'color_mode' ];

  if ( $theme_choice === "light" ) {
    $theme_choice = "light";
  } elseif ( $theme_choice === "flat" ) {
    $theme_choice = "flat";
  } elseif ( $theme_choice === "material" ) {
    $theme_choice = "material";
  } elseif ( $theme_choice === "social" ) {
    $theme_choice = "social";
  } else {
    $theme_choice = "dark";
  }

} else {

  $theme_choice = "dark";

}

?>
<script>	
jQuery(function () {
	
jQuery(".first").attr("id", "<?php echo $theme_choice ?>");	
	
jQuery("#color_mode").on("change", function () {
	
var colorMode = jQuery("#color_mode").val();
	
jQuery(".first").attr("id", colorMode);	
	
});
	
});

</script>
<?php
}

public function link_target_0_callback() {

  ?>
<fieldset>
  <?php $checked = ( isset( $this->simple_alert_system_options['link_target_0'] ) && $this->simple_alert_system_options['link_target_0'] === '_blank' ) ? 'checked' : '' ; ?>
  <label for="link_target_0-0" class="container">
    <input type="radio" name="simple_alert_system_option_name[link_target_0]" id="link_target_0-0" value="_blank" <?php echo $checked; ?>>
    <?php _e('Blank', 'simple-alert-system') ?>
    <span class="checkmark"></span></label>
  <?php $checked = ( isset( $this->simple_alert_system_options['link_target_0'] ) && $this->simple_alert_system_options['link_target_0'] === '_self' ) ? 'checked' : '' ; ?>
  <label for="link_target_0-1" class="container">
    <input type="radio" name="simple_alert_system_option_name[link_target_0]" id="link_target_0-1" value="_self" <?php echo $checked; ?>>
    <?php _e('Self', 'simple-alert-system') ?>
    <span class="checkmark"></span></label>
  <?php $checked = ( isset( $this->simple_alert_system_options['link_target_0'] ) && $this->simple_alert_system_options['link_target_0'] === '_parent' ) ? 'checked' : '' ; ?>
  <label for="link_target_0-2" class="container">
    <input type="radio" name="simple_alert_system_option_name[link_target_0]" id="link_target_0-2" value="_parent" <?php echo $checked; ?>>
    <?php _e('Parent', 'simple-alert-system') ?>
    <span class="checkmark"></span></label>
  <?php $checked = ( isset( $this->simple_alert_system_options['link_target_0'] ) && $this->simple_alert_system_options['link_target_0'] === '_top' ) ? 'checked' : '' ; ?>
  <label for="link_target_0-3" class="container">
    <input type="radio" name="simple_alert_system_option_name[link_target_0]" id="link_target_0-3" value="_top" <?php echo $checked; ?>>
    <?php _e('Top', 'simple-alert-system') ?>
    <span class="checkmark" class="container"></span></label>
</fieldset>
<script>
  jQuery( function() {
	  // Construct Schedule date
	  jQuery( "#sas_start_date, #sas_end_date" ).datepicker();
	  jQuery( "#sas_start_date, #sas_end_date" ).on("change", function() {
	  setTimeout(function() {
	  var sas_start_date = jQuery( "#sas_start_date" ).val();
	  
		var sas_end_date = jQuery( "#sas_end_date" ).val();
		  
		  if(sas_start_date !== "" && sas_end_date !== "") {
			 
			 jQuery("#date").val(sas_start_date + " " + sas_end_date);
			 
			 }
		    var now  = new Date();
		    now.setHours(0,0,0,0);
		    
		   if(Date.parse(sas_end_date) < now) {
			  
            jQuery("#sas_end_date").siblings(".call-to-action").text('<?php _e('Sorry: The end date must be today, or a future date.', 'simple-alert-system') ?>').addClass("Err");
			   
			jQuery("#sas_end_date").val("");
			   
           } else {
			   
		   jQuery("#sas_end_date").siblings(".call-to-action").text("<?php _e('Click on each field to set date', 'simple-alert-system') ?>").removeClass("Err");   
			   
		   }
		
		}, 1000); // A litle delay to wait for both values

	  });
	  
	  
    });
</script>
<?php

}


public function sas_scope_0_callback() {

  $fieldOff = $scopeRange = $selected = "";

  if ( !empty( $this->simple_alert_system_options[ 'sas_scope_0' ] ) ) {

    $scopeRange = explode( " ", trim( $this->simple_alert_system_options[ 'sas_scope_0' ] ) );

    $scopeRange = implode( ' ', $scopeRange );
  }

  ?>
<select name="simple_alert_system_option_name[sas_scope_0]" id="sas_scope_0">
  <?php
  $selected = explode( " ", $scopeRange );
  $selected = end( $selected )
  ?>
  <option key="1" <?php if($selected === '1') { 
	 // $keyOneValue = $scopeRange;
	  echo "selected"; } ?> 
	 value="<?php echo $scopeRange ?>">
  <?php _e('All pages, except', 'simple-alert-system') ?>
  </option>
  <option key="2" <?php if($selected === '2') { 
	 // $keyTwoValue = $scopeRange;
	  echo "selected"; } ?> 
	  value="<?php echo $scopeRange ?>">
  <?php _e('Just these pages', 'simple-alert-system') ?>
  </option>
  <option key="3" <?php if($selected === '3') { 
	  $fieldOff = "disabled"; 
	  echo "selected"; } ?> 
	  value="<?php _e('Show on all pages', 'simple-alert-system') ?>">
  <?php _e("All pages") ?>
  </option>
</select>
<input type="text" id="sas_scope" value="<?php echo substr_replace($scopeRange,"", -3) ?>" placeholder="<?php _e('Example: about-us, contact','simple-alert-system') ?>" <?php echo $fieldOff ?>>
<a class="call-to-action douleLine">
<?php
_e( 'Separate each page slug entry with a comma. <br>
For home page, add the word "home"', 'simple-alert-system' )
?>
</a> 
<script>
jQuery(function () {
 // Construct Display Scope
	  jQuery("#sas_scope_0").on("change", function () {

       var sas_scope = jQuery("#sas_scope").val();

          var sas_selected = jQuery("#sas_scope_0 option:selected").attr("key");

          if(sas_selected === "1") {

           jQuery("#sas_scope_0 option[key=1]:selected").attr('value', sas_scope + ", " + sas_selected);
			 jQuery("#sas_scope").attr("value", "<?php echo substr_replace($scopeRange,"", -3) ?>").removeAttr('disabled');

           } else if(sas_selected === "2") {

           jQuery("#sas_scope_0 option[key=2]:selected").attr('value', sas_scope + ", " + sas_selected);
		   jQuery("#sas_scope").attr("value", "<?php echo substr_replace($scopeRange,"", -3) ?>").removeAttr('disabled');
			   
          } else if(sas_selected === "3") {
		   
		  jQuery("#sas_scope_0 option[key=3]:selected").attr('value', "<?php _e('Show on all pages', 'simple-alert-system') ?>" + ", " + sas_selected);  
		
		  jQuery("#sas_scope").attr({'value': "<?php _e('Show on all pages', 'simple-alert-system') ?>", 'disabled': "true"}).addClass("show_all_apages");
		   
	     }
		  	  
       });	
	  
	  
	  // Construct Display Scope
	  jQuery("#sas_scope").on("blur", function () {

         var sas_scope = jQuery("#sas_scope").val();

          var sas_selected = jQuery("#sas_scope_0 option:selected").attr("key");

          if(sas_selected === "1") {

           jQuery("#sas_scope_0 option[key=1]:selected").attr('value', sas_scope + ", " + sas_selected);

           } else if(sas_selected === "2") {

           jQuery("#sas_scope_0 option[key=2]:selected").attr('value', sas_scope + ", " + sas_selected);
			   
          } 
		  	  
       });	
	
	// Set button style value
	jQuery("#cta-style").on("change", function () {
	
       var ctaDefaultVal = "<?php _e('Learn More', 'simple-alert-system') ?>";
		
	   var ctaUserVal = jQuery(".cta").val();
		
	   var ctaStyle = jQuery("#cta-style").val();
		
	   if(ctaUserVal === "") {
		   
		 jQuery(".ctaText").val(ctaDefaultVal + " " + ctaStyle)
		   
	   } else {
		   
		 jQuery(".ctaText").val(ctaUserVal + " " + ctaStyle)
		   
	   }
		
	});
	
	jQuery(".cta").on("blur", function () {
		var ctaUserVal = jQuery(this).val();
		var ctaStyle = jQuery("#cta-style").val();
		if(ctaUserVal === "") {
			jQuery(".ctaText").val("")
		} else {
			jQuery(".ctaText").val(ctaUserVal + " " + ctaStyle);
		}
	});
	
	
});
</script>
<?php
}


public function sas_cta_callback() {


  // Construct returned saved value
  $ctaVal = $ctaStyle = $b_selected = $bg_selected = "";

  if ( !empty( $this->simple_alert_system_options[ 'sas_cta' ] ) ) {

    $ctaVal = explode( " ", trim( $this->simple_alert_system_options[ 'sas_cta' ] ) );

    $ctaVal = implode( ' ', $ctaVal );

    // Divide and extract the button text and style values
    $ctaVal = preg_replace( '/\W\w+\s*(\W*)$/', '$1', $ctaVal );

    $ctaStyle = explode( " ", trim( $this->simple_alert_system_options[ 'sas_cta' ] ) );

    $ctaStyle = end( $ctaStyle );

    if ( $ctaStyle === "border" ) {
      $b_selected = "selected";
    } elseif ( $ctaStyle === "background" ) {
      $bg_selected = "selected";
    }
  }

  // Internationalize placeholders and prompters
  $ctaLearnMore = __( 'Example: Learn More', 'simple-alert-system' );
  $ctaPrompt = __( 'Recommended, but not required', 'simple-alert-system' );
  $ctaSelectPrompt = __( 'Choose Button Style', 'simple-alert-system' );
  $ctaSelectPromptOne = __( 'Button with border', 'simple-alert-system' );
  $ctaSelectPromptTwo = __( 'Button with background', 'simple-alert-system' );

  printf(

    '<input class="regular-text ctaText" type="hidden" name="simple_alert_system_option_name[sas_cta]" id="title" value="%s">
	<input class="cta" type="text" id="title" placeholder="' . $ctaLearnMore . '" value="' . $ctaVal . '"></div> 
	
	<select id="cta-style">
      <option value="noChoice">' . $ctaSelectPrompt . '</option>
      <option value="border"' . $b_selected . '>' . $ctaSelectPromptOne . '</option>
      <option value="background"' . $bg_selected . '>' . $ctaSelectPromptTwo . '</option>
   </select>
	
	<a class="call-to-action">' . $ctaPrompt . '</a></div>',

    isset( $this->simple_alert_system_options[ 'sas_cta' ] ) ? esc_attr( $this->simple_alert_system_options[ 'sas_cta' ] ) : ''

  );

}


public function sas_schedule_callback() {

  if ( !empty( $this->simple_alert_system_options[ 'sas_schedule' ] ) ) {

    $perDate = explode( " ", trim( $this->simple_alert_system_options[ 'sas_schedule' ] ) );

    ?>
<script>
  jQuery(function () { 
	 jQuery( "#sas_start_date" ).val('<?php echo $perDate[0] ?>');
	 jQuery( "#sas_end_date" ).val('<?php echo $perDate[1] ?>');
  });

 </script>
<?php

}

// Internationalize Placeholders and Prompters	
$datePrompt = __( "Click on each field to set date", 'simple-alert-system' );
$dateph = __( "Start Date", 'simple-alert-system' );
$datePh1 = __( "End Date", 'simple-alert-system' );
$dateConnect = __( "To", 'simple-alert-system' );


printf(

  '<input class="regular-text" type="hidden" name="simple_alert_system_option_name[sas_schedule]" id="date" value="%s"></div> 
	<div class="sas-cal-label"><span class="dashicons dashicons-calendar"></span></div><input type="text" id="sas_start_date" placeholder="' . $dateph . '" autocomplete="off" Required>
	<span class="sas_date_range">' . $dateConnect . '</span>
	<div class="sas-cal-label"><span class="dashicons dashicons-calendar"></span></div><input type="text" id="sas_end_date" placeholder="' . $datePh1 . '" autocomplete="off" Required>
	<a class="call-to-action">' . $datePrompt . '</a></div>',

  isset( $this->simple_alert_system_options[ 'sas_schedule' ] ) ? esc_attr( $this->simple_alert_system_options[ 'sas_schedule' ] ) : ''

);

}


public function link_callback() {

  // Internationalize Placeholders and Prompters	
  $linkPh = __( "Provide alert link", 'simple-alert-system' );
  $linkPrompt = __( "Link the alert to a desired location", 'simple-alert-system' );

  printf(

    '<input class="regular-text" type="url" name="simple_alert_system_option_name[link]" id="title" value="%s" placeholder="' . $linkPh . '"></div> <a class="call-to-action">' . $linkPrompt . '</a></div>',

    isset( $this->simple_alert_system_options[ 'link' ] ) ? esc_attr( $this->simple_alert_system_options[ 'link' ] ) : ''

  );

}


public function enable_custom_callback() {


  printf(


    '<label class="switch"><input type="checkbox" name="simple_alert_system_option_name[enable_custom]" id="tenable_alert" value="enable_custom" %s><span class="slider round"></span></label>',


    ( isset( $this->simple_alert_system_options[ 'enable_custom' ] ) && $this->simple_alert_system_options[ 'enable_custom' ] === 'enable_custom' ) ? 'checked' : ''


  );


}


public function bgColor_callback() {

  $startDatePrompt = __( 'Click field to select color', 'simple-alert-system' );

  printf(

    '<input class="large-text" type="color" name="simple_alert_system_option_name[bgColor]" id="bgColor" value="%s">' . '<div> <a class="call-to-action">' . $startDatePrompt . '</a></div>',

    isset( $this->simple_alert_system_options[ 'bgColor' ] ) ? esc_attr( $this->simple_alert_system_options[ 'bgColor' ] ) : ''

  );

}


public function fontColor_callback() {

  $endDatePrompt = __( 'Click field to select color', 'simple-alert-system' );

  printf(

    '<input class="large-text" type="color" name="simple_alert_system_option_name[fontColor]" id="fontColor" value="%s">' . '<div> <a class="call-to-action">' . $endDatePrompt . '</a></div>',

    isset( $this->simple_alert_system_options[ 'fontColor' ] ) ? esc_attr( $this->simple_alert_system_options[ 'fontColor' ] ) : ''

  );

}

}


if ( is_admin() )

  $simple_alert_system = new SimpleAlertSystem();
