<?php
// Registers a new custom post type "Cities"
function create_cities_post_type() {
    $labels = array(
        'name'               => __('Cities'), // Name for all elements of the type
        'singular_name'      => __('City'), // Name for a single element
        'menu_name'          => __('Cities'), // Menu name in the admin panel
        'all_items'          => __('All Cities'), // Text for "All items" link
        'add_new'            => __('Add New City'), // Text for the "Add new" button
        'add_new_item'       => __('Add New City'), // Text for adding a new item
        'edit_item'          => __('Edit City'), // Text for editing an item
        'new_item'           => __('New City'), // Text for a new item
        'view_item'          => __('View City'), // Text for viewing an item
        'search_items'       => __('Search Cities'), // Text for searching items
        'not_found'          => __('No Cities found'), // Text if nothing is found
        'not_found_in_trash' => __('No Cities found in Trash'), // Text if nothing is found in trash
    );

    $args = array(
        'labels'             => $labels, // Use the labels array
        'public'             => true, // Make the post type public
        'has_archive'        => true, // Enable archive for the post type
        'rewrite'            => array('slug' => 'cities'), // Specify the slug for URLs
        'supports'           => array('title', 'editor', 'thumbnail'), // Enable support for standard fields
        'show_in_rest'       => true,  // Enable REST API and Gutenberg support
    );

    // Register the new post type
    register_post_type('cities', $args);
}
add_action('init', 'create_cities_post_type');
