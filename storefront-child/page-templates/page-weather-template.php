<?php
/**
 * Template Name: Page Weather Template
 */
get_header(); ?>

<div id="weather-table-section">
    <?php do_action('before_weather_table'); // Custom action hook before table ?>

    <!-- City weather search form -->
    <div id="weather-table-container">
        <form id="weather-search-form">
            <label for="search_city">Enter city:</label>
            <input type="text" id="search_city" name="search_city" placeholder="Search by cities">
            <button type="submit">Search</button>
        </form>
        <div id="weather-table">
            <!-- The table data will be loaded via AJAX -->
        </div>
    </div>

    <?php do_action('after_weather_table'); // Custom action hook after table ?>
</div>

<?php get_footer(); ?>