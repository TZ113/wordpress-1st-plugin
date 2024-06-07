<?php
/*
Plugin Name: My First Awesome Plugin
Description: Adds a custom button to the homepage and displays a message once clicked.
Version: 1.0
Author: T Z
*/


class MFAP_My_First_Awesome_Plugin {
    
    // 
    function __construct() {
        add_shortcode('custom_btn_n_msg', array($this, 'custom_btn_n_msg_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'custom_btn_n_msg_assets'));
        add_action('wp', array($this, 'add_custom_btn_n_msg_to_homepage'));
    }


    // Register the shortcode
    function custom_btn_n_msg_shortcode($atts) {
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


    // Enqueue scripts and styles
    function custom_btn_n_msg_assets() {
        wp_enqueue_style('custom-btn-n-msg-styles', plugin_dir_url(__FILE__) . 'css/custom-btn-n-msg-styles.css');
        wp_enqueue_script('custom-btn-n-msg-script', plugin_dir_url(__FILE__) . 'js/custom-btn-n-msg-script.js', array('jquery'), null, true);
    }


    // Output the shortcode
    function prepend_custom_btn_n_msg() {
        echo do_shortcode('[custom_btn_n_msg]');
    }


    // Add button to homepage header section
    function add_custom_btn_n_msg_to_homepage() {
        if (is_shop() || is_front_page()) {
            // Append the button shortcode to the homepage header
            add_filter('storefront_header', array($this, 'prepend_custom_btn_n_msg'));
        }
    }
}


// Create an instance of the class
new MFAP_My_First_Awesome_Plugin();


















