<?php 
/*
Plugin Name: MA Bootstrap Contact Form
Description: Contact Form using Bootstrap styling, available in swedish and english
Version: 1.4
Author: Malin Antonsson
Author URI: http://malinantonsson.com/
Plugin URI: http://malinantonsson.com/bootstrap-contact-form
*/



define('MA_BOOTSTRAPCONTACTFORM_DIR', plugin_dir_path(__FILE__));
define('MA_BOOTSTRAPCONTACTFORM_URL', plugin_dir_url(__FILE__));

//option page
function bootstrapcontactform_admin() {
    include(MA_BOOTSTRAPCONTACTFORM_DIR.'includes/admin.php');
}

function ma_bootstrapcontactform_admin_actions() {
 	add_options_page("Bootstrap Contact Form", "Bootstrap Contact Form", 1, "Bootstrap_Contact_Form", "bootstrapcontactform_admin");
}
 
add_action('admin_menu', 'ma_bootstrapcontactform_admin_actions');


//core functions
function bootstrapcontactform_shortcode_swedish() {	
	include(MA_BOOTSTRAPCONTACTFORM_DIR.'includes/core.php');
    ob_start();
    ma_deliver_mail(swe);
    ma_html_form_code_swe(); 
    return ob_get_clean();
}
	add_shortcode( 'bootstrapcontactform_swedish', 'bootstrapcontactform_shortcode_swedish' );
	
function bootstrapcontactform_shortcode_english() {
	include(MA_BOOTSTRAPCONTACTFORM_DIR.'includes/core.php');
    ob_start();
    ma_deliver_mail(eng);
    ma_html_form_code_eng();
 
    return ob_get_clean();
}

	add_shortcode( 'bootstrapcontactform_english', 'bootstrapcontactform_shortcode_english' );
?>