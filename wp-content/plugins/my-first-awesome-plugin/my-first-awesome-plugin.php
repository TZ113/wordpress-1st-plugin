<?php
/*
Plugin Name: My First Awesome Plugin
Description: Adds a custom button to the homepage and displays a message once clicked.
Version: 1.0
Author: T Z
*/

// Register the shortcode with a prefixed function name
function mfap_custom_btn_n_msg_shortcode($atts) {
    $attributes = shortcode_atts(
        array(
            'text' => 'Click Me',
            'url' => '#'
        ), $atts );

    $output = '<a href="javascript:void(0);" class="mfap-custom-button" onclick="showMessage()">' . esc_html($attributes['text']) . '</a>';
    $output .= '<div id="mfap-message" style="display:none; margin-top:10px;">Oh.. you clicked me.</div>';

    return $output;
}
add_shortcode('mfap_custom_btn_n_msg', 'mfap_custom_btn_n_msg_shortcode');


// Enqueue scripts and styles with a prefixed function name
function mfap_custom_btn_n_msg_assets() {
    wp_enqueue_style('mfap-custom-btn-n-msg-styles', plugin_dir_url(__FILE__) . 'css/custom-btn-n-msg-styles.css');
    wp_enqueue_script('mfap-custom-btn-n-msg-script', plugin_dir_url(__FILE__) . 'js/custom-btn-n-msg-script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mfap_custom_btn_n_msg_assets');


// Add button to homepage with prefixed function names
function mfap_add_custom_btn_n_msg_to_homepage() {
    if (is_front_page()) {
        // Append the button shortcode to the homepage content
        add_filter('the_content', 'mfap_prepend_custom_btn_n_msg');
    }
}


function mfap_prepend_custom_btn_n_msg($content) {
    $button = do_shortcode('[mfap_custom_btn_n_msg text="Learn More" url="https://example.com"]');
    return $button . $content;
}

add_action('wp', 'mfap_add_custom_btn_n_msg_to_homepage');
