<?php
/**
 * Gets weather data for the specified city via OpenWeatherMap API.
 * 
 * @param string $city City name for weather search.
 * @return array|WP_Error Weather data or error.
 */
function get_weather_data_from_api($city) {
    $api_key = '1d16d0b56233518c198961d3f2f0003c';  // API key OpenWeatherMap
    $api_url = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&units=metric&appid=" . $api_key;

    // We execute a request to API
    $response = wp_remote_get($api_url);

    // Checking for errors
    if (is_wp_error($response)) {
        return new WP_Error('api_error', 'Failed to complete API request.');
    }

    $weather_data = json_decode(wp_remote_retrieve_body($response), true);

    // Checking the API response code
    if ($weather_data['cod'] !== 200) {
        return new WP_Error('city_not_found', 'City not found.');
    }

    return $weather_data;
}
