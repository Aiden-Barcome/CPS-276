<?php

function getWeather(){
    $html="";
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code={$_POST['zip_code']}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response=curl_exec($ch);
    if($response===false){
        echo 'Curl error: ' . curl_error($ch);
    } else{
        echo $response;
    }

    $data = json_decode($response, true);
    
    // Close the cURL session
    curl_close($ch);

    // Output HTML
    if ($data) {
        // Start the HTML output
        echo "<h2>Weather for " . $data['searched_city']['name'] . "</h2>";
        echo "<p>Temperature: " . $data['searched_city']['temperature'] . "</p>";
        echo "<p>Humidity: " . $data['searched_city']['humidity'] . "</p>";
        
        // Display the forecast
        echo "<h3>3-Day Forecast</h3><ul>";
        foreach ($data['searched_city']['forecast'] as $day) {
            echo "<li>" . $day['day'] . ": " . $day['condition'] . "</li>";
        }
        echo "</ul>";
        
        // Display cooler cities
        echo "<h3>Cooler Cities</h3><ul>";
        foreach ($data['lower_temperatures'] as $city) {
            echo "<li>" . $city['name'] . " - " . $city['temperature'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Error processing the weather data.</p>";
}
}

?>