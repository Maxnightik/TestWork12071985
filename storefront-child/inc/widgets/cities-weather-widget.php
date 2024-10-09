<?php
// Cities Weather Widget
class Cities_Weather_Widget extends WP_Widget {

    // Construct the widget.
    public function __construct() {
        parent::__construct(
            'cities_weather_widget', // Base ID
            __('Cities Weather Widget', 'text_domain'), // Name
            array('description' => __('Displays the weather for selected city.', 'text_domain'),) // Args
        );
    }

    /**
     * Outputs the content of the widget.
     *
     * @param array $args Arguments from the widget area.
     * @param array $instance Previously saved values from database.
     */
    public function widget($args, $instance) {
        $city_id = !empty($instance['city_id']) ? $instance['city_id'] : ''; // Get city ID from instance
        if ($city_id) {
            $city = get_post($city_id); // Get city post
            $city_name = $city->post_title; // Get city name
            $temperature = $this->get_weather($city_name); // Get temperature

            echo $args['before_widget'];
            echo $args['before_title'] . esc_html($city_name) . $args['after_title']; // Display city name
            echo '<p>' . __('Current Temperature: ', 'text_domain') . esc_html($temperature) . ' °C</p>'; // Display temperature
            echo $args['after_widget'];
        }
    }

    /**
     * Backend widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $city_id = !empty($instance['city_id']) ? $instance['city_id'] : ''; // Get city ID from instance
        $cities = get_posts(array('post_type' => 'cities', 'numberposts' => -1)); // Get all cities

        echo '<label for="' . $this->get_field_id('city_id') . '">' . __('Select City:', 'text_domain') . '</label>';
        echo '<select id="' . $this->get_field_id('city_id') . '" name="' . $this->get_field_name('city_id') . '">';
        foreach ($cities as $city) {
            echo '<option value="' . $city->ID . '"' . selected($city_id, $city->ID, false) . '>' . esc_html($city->post_title) . '</option>'; // Populate dropdown
        }
        echo '</select>';
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['city_id'] = (!empty($new_instance['city_id'])) ? strip_tags($new_instance['city_id']) : ''; // Sanitize city ID
        return $instance;
    }

    /**
     * Fetches the current weather for the given city.
     *
     * @param string $city_name Name of the city.
     * @return float Current temperature in Celsius.
     */
    private function get_weather($city_name) {
        $api_key = '1d16d0b56233518c198961d3f2f0003c'; // Replace with your OpenWeatherMap API key
        $response = wp_remote_get("http://api.openweathermap.org/data/2.5/weather?q={$city_name}&units=metric&appid={$api_key}");
        
        if (is_wp_error($response)) {
            return __('Unable to retrieve weather data', 'text_domain'); // Error message
        }

        $data = json_decode(wp_remote_retrieve_body($response)); // Decode JSON response

        if (isset($data->main->temp)) {
            return $data->main->temp; // Return temperature
        }

        return __('Weather data not available', 'text_domain'); // Error message
    }
}

// Register the widget
function register_cities_weather_widget() {
    register_widget('Cities_Weather_Widget');
}
add_action('widgets_init', 'register_cities_weather_widget');
