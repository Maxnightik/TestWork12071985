<?php
// Connecting the parent theme
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');
function enqueue_parent_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

// Connecting the custom post type file Cities
require_once get_stylesheet_directory() . '/inc/custom-post-types/cities.php';

// Connecting the metabox file for Cities
require_once get_stylesheet_directory() . '/inc/meta-boxes/cities-meta-box.php';

// Connecting the mcustom taxonomies file for Cities
require_once get_stylesheet_directory() . '/inc/custom-taxonomies/countries.php';

// Connecting the mcustom widget file for Cities
require_once get_stylesheet_directory() . '/inc/widgets/cities-weather-widget.php';

// Connecting files with handlers
require get_stylesheet_directory() . '/inc/weather-api-handler.php';
require get_stylesheet_directory() . '/inc/ajax-handler.php';

// Registering and connecting scripts for AJAX
function enqueue_weather_search_script() {
    wp_enqueue_script('weather-search', get_stylesheet_directory_uri() . '/assets/js/weather-search.js', ['jquery'], null, true);

    // Get URL for admin-ajax.php
    $ajax_url = admin_url('admin-ajax.php');

    // Add a variable with a URL to the script
    wp_add_inline_script('weather-search', 'var ajaxurl = "' . esc_url($ajax_url) . '";', 'before');
}
add_action('wp_enqueue_scripts', 'enqueue_weather_search_script');

// Output custom action hook before weather table
function custom_before_weather_table_message() {
    echo '<p>This message is displayed before the weather table..</p>';
}
add_action('before_weather_table', 'custom_before_weather_table_message');

// Output custom action hook after weather table
function custom_after_weather_table_message() {
    echo '<p>This message is displayed after the weather table..</p>';
}
add_action('after_weather_table', 'custom_after_weather_table_message');

// Remove the default WordPress action to terminate the script
remove_action("shutdown", "wp_ob_end_flush_all",1);