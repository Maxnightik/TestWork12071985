<?php
// Registers a custom taxonomy "Countries" for the "Cities" post type.
function create_countries_taxonomy() {
    $labels = array(
        'name'              => _x('Countries', 'taxonomy general name'), // General name for the taxonomy
        'singular_name'     => _x('Country', 'taxonomy singular name'), // Singular name for a single item
        'search_items'      => __('Search Countries'), // Label for the search function
        'all_items'         => __('All Countries'), // Label for viewing all items
        'parent_item'       => __('Parent Country'), // Label for the parent item
        'parent_item_colon' => __('Parent Country:'), // Label for the parent item with a colon
        'edit_item'         => __('Edit Country'), // Label for editing an item
        'update_item'       => __('Update Country'), // Label for updating an item
        'add_new_item'      => __('Add New Country'), // Label for adding a new item
        'new_item_name'     => __('New Country Name'), // Label for the new item name
        'menu_name'         => __('Countries'), // Label for the menu item
    );

    $args = array(
        'hierarchical'      => true, // Set to true for a hierarchical taxonomy like categories
        'labels'            => $labels, // Use the defined labels
        'show_ui'           => true, // Show the user interface for managing the taxonomy
        'show_admin_column' => true, // Show the taxonomy in the admin column
        'query_var'         => true, // Allow querying of the taxonomy
        'rewrite'           => array('slug' => 'country'), // Set the slug for pretty permalinks
        'show_in_rest'       => true,  // Enable REST API and Gutenberg support
    );

    // Register the taxonomy and associate it with the "Cities" post type
    register_taxonomy('countries', array('cities'), $args);
}
add_action('init', 'create_countries_taxonomy'); // Hook the function into the init action