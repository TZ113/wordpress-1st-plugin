<?php
/*
Plugin Name: My First Awesome Plugin
Plugin URI: http://example.com/my-awesome-first-plugin
Description: Adds a custom button to the homepage and displays a message once clicked.
Version: 1.0
Author: T Z
*/

/* 
All function names are prefixed with `mfap`, short for "my first awesome plugin" to avoid conflicts with other plugins
*/


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// This code runs during plugin activation
function activate_my_first_awesome_plugin() {
   
}


// This code runs during plugin deactivation
function deactivate_my_first_awesome_plugin() {

}


register_activation_hook(__FILE__, "activate_my_first_awesome_plugin");
register_deactivation_hook(__FILE__, "deactivate_my_first_awesome_plugin");


// Register the shortcode
function mfap_custom_btn_n_msg_shortcode($atts) {
    // Define default attributes for the shortcode
    $attributes = shortcode_atts(
        array(
            'text' => 'Click Me',
            'url' => '#'
        ), $atts );

    // Create the button with an onclick event to show the message
    $output = '<a href="javascript:void(0);" class="mfap-custom-button" onclick="mfap_showMessage()">' . esc_html($attributes['text']) . '</a>';
    $output .= '<div id="mfap-message" style="display:none; margin-top:10px;">&#x2764;&#xFE0F; Oh.. you clicked me &#x2764;&#xFE0F;</div>';

    return $output;
}
add_shortcode('mfap_custom_btn_n_msg', 'mfap_custom_btn_n_msg_shortcode');


// Enqueue scripts and styles
function mfap_custom_btn_n_msg_assets() {
    wp_enqueue_style('mfap-custom-btn-n-msg-styles', plugin_dir_url(__FILE__) . 'css/custom-btn-n-msg-styles.css');
    wp_enqueue_script('mfap-custom-btn-n-msg-script', plugin_dir_url(__FILE__) . 'js/custom-btn-n-msg-script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mfap_custom_btn_n_msg_assets');


// Output the shortcode
function mfap_prepend_custom_btn_n_msg() {
    echo do_shortcode('[mfap_custom_btn_n_msg]');
}


// Add button to homepage header section
function mfap_add_custom_btn_n_msg_to_homepage() {
    if (is_shop() || is_front_page()) {
        // Append the button shortcode to the homepage header
        add_filter('storefront_header', 'mfap_prepend_custom_btn_n_msg');
    }
}



add_action('wp', 'mfap_add_custom_btn_n_msg_to_homepage');
