<?php

$apiKey = '60d583b1aafaed9e55eb0943f79f5ea6';

$city = 'Владимир';

$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, value: $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "Ошибка запроса: " . curl_error($curl);
} else {
    $weatherData = json_decode($response, true);

    if ($weatherData['cod'] == 200) {
        $temperature = $weatherData['main']['temp'];   // Температура в градусах Цельсия
        $description = $weatherData['weather'][0]['description']; // Описание погоды
        $icon = $weatherData['weather'][0]['icon'];    // Значок погоды

        echo "<h2>Погода в $city</h2>";
        echo "<p><strong>Температура:</strong> $temperature °C</p>";
        echo "<p><strong>Описание:</strong> $description</p>";
        echo "<img src=\"http://openweathermap.org/img/wn/$icon@2x.png\" alt=\"Значок погоды\"/>";
    } else {
        echo "Ошибка: " . $weatherData['message'];
    }
}

curl_close($curl);
?>
