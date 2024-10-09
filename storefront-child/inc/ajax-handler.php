<?php
// AJAX request handler for searching weather by city.
 
function ajax_get_weather_data() {
    // Checking for availability of city data
    if (!isset($_POST['city']) || empty($_POST['city'])) {
        wp_send_json_error('City not specified.');
        return;
    }

    // We get and filter the name of the city
    $city = sanitize_text_field($_POST['city']);

    // Getting weather data
    $weather_data = get_weather_data_from_api($city);

    // Checking errors when requesting API
    if (is_wp_error($weather_data)) {
        wp_send_json_error($weather_data->get_error_message());
        return;
    }

    // Formatting data for output
    $country = $weather_data['sys']['country'];
    $temperature = $weather_data['main']['temp'];

    // Output the table
    ob_start(); ?>
    <table border="1">
        <thead>
            <tr>
                <th>Country</th>
                <th>City</th>
                <th>Temperature (°C)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo esc_html($country); ?></td>
                <td><?php echo esc_html($city); ?></td>
                <td><?php echo esc_html($temperature); ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    wp_send_json_success(ob_get_clean());
}

// Registering an AJAX action
add_action('wp_ajax_get_weather_data', 'ajax_get_weather_data');
add_action('wp_ajax_nopriv_get_weather_data', 'ajax_get_weather_data');
