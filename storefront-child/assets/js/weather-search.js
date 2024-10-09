 jQuery(document).ready(function($) {
    $('#weather-search-form').on('submit', function(e) {
        e.preventDefault();
        let city = $('#search_city').val();

        // Performing an AJAX request to get weather data
        $.ajax({
            url: ajaxurl,  // WordPress variable for admin-ajax.php
            type: 'POST',
            data: {
                action: 'get_weather_data',
                city: city,
            },
            success: function(response) {
                if (response.success) {
                    $('#weather-table').html(response.data);
                } else {
                    $('#weather-table').html('<p>' + response.data + '</p>');
                }
            },
            error: function() {
                $('#weather-table').html('<p>An error has occurred. Please try again..</p>');
            }
        });
    });
});
