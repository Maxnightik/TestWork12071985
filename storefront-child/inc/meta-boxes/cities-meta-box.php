<?php

/**
 * Adds a metabox for the "Cities" post type.
 */
function cities_add_meta_box() {
    add_meta_box(
        'cities_meta_box', // Unique ID for the metabox
        __('City Coordinates'), // Metabox title
        'cities_meta_box_callback', // Callback function to display the content
        'cities', // Post type to which the metabox is attached
        'normal', // Metabox location (normal — main content area)
        'high' // Metabox priority
    );
}
add_action('add_meta_boxes', 'cities_add_meta_box');

/**
 * Callback function to display the metabox fields.
 * 
 * @param WP_Post $post The current post object.
 */
function cities_meta_box_callback($post) {
    // Get saved latitude and longitude values
    $latitude = get_post_meta($post->ID, 'city_latitude', true);
    $longitude = get_post_meta($post->ID, 'city_longitude', true);

    // Display field for latitude input
    echo '<label for="city_latitude">' . __('Latitude') . '</label>';
    echo '<input type="text" id="city_latitude" name="city_latitude" value="' . esc_attr($latitude) . '" size="25" />';
    
    echo '<br/><br/>';

    // Display field for longitude input
    echo '<label for="city_longitude">' . __('Longitude') . '</label>';
    echo '<input type="text" id="city_longitude" name="city_longitude" value="' . esc_attr($longitude) . '" size="25" />';
}

/**
 * Saves the metabox data when the post is saved.
 * 
 * @param int $post_id The ID of the current post.
 */
function save_cities_meta_box_data($post_id) {
    // Check if data exists for saving
    if (!isset($_POST['city_latitude']) || !isset($_POST['city_longitude'])) {
        return;
    }

    // Save latitude value
    $latitude = sanitize_text_field($_POST['city_latitude']);
    update_post_meta($post_id, 'city_latitude', $latitude);

    // Save longitude value
    $longitude = sanitize_text_field($_POST['city_longitude']);
    update_post_meta($post_id, 'city_longitude', $longitude);
}
add_action('save_post', 'save_cities_meta_box_data');
