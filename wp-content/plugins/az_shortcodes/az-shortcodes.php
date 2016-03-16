<?php
/*
Plugin Name: AZ Shortcodes
Plugin URI: http://www.alessioatzeni.com/
Description: Custom Shortcodes for <strong>Klaus Theme</strong> Only.
Author: Alessio Atzeni
Author URI: http://www.alessioatzeni.com
Version: 1.1
*/


// TRANSLATION
load_plugin_textdomain( 'textdomain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcodes
/*-----------------------------------------------------------------------------------*/

function is_edit_page($new_edit = null){
    global $pagenow;
    if (!is_admin()) return false;
    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new")
        return in_array( $pagenow, array( 'post-new.php' ) );
    else
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

function az_shortcode_init() {
	if(is_admin()){
		if(is_edit_page()){
			require_once( plugin_dir_path( __FILE__ ) .'tinymce/tinymce-class.php' );	
		}
	}
}

add_action('init', 'az_shortcode_init');

//Add button to page
add_action('media_buttons','az_buttons',100);

function az_buttons() {
     echo "<a data-effect='mfp-zoom-in' class='button button-primary az-shortcode-generator' href='#shortcode-generator'>AZ Shortcodes</a>";
}

require_once( plugin_dir_path( __FILE__ ) .'tinymce/shortcode-processing.php' );
define('AZ_TINYMCE_URI', plugin_dir_url( __FILE__ ) .'tinymce');
define('AZ_TINYMCE_DIR', plugin_dir_path( __FILE__ ) .'tinymce');

?>