<?php
// Ваш API ключ OpenWeather
$apiKey = '60d583b1aafaed9e55eb0943f79f5ea6';

// Город, для которого запрашивается погода
$city = 'Владимир';

// URL для запроса к API OpenWeather
$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

// Инициализация cURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, value: $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса и получение ответа
$response = curl_exec($curl);

// Проверка наличия ошибок
if (curl_errno($curl)) {
    echo "Ошибка запроса: " . curl_error($curl);
} else {
    // Декодирование JSON-ответа
    $weatherData = json_decode($response, true);

    // Проверка статуса ответа (должен быть 200)
    if ($weatherData['cod'] == 200) {
        // Получение основной информации о погоде
        $temperature = $weatherData['main']['temp'];   // Температура в градусах Цельсия
        $description = $weatherData['weather'][0]['description']; // Описание погоды
        $icon = $weatherData['weather'][0]['icon'];    // Значок погоды

        // Форматированный вывод информации
        echo "<h2>Погода в $city</h2>";
        echo "<p><strong>Температура:</strong> $temperature °C</p>";
        echo "<p><strong>Описание:</strong> $description</p>";
        echo "<img src=\"http://openweathermap.org/img/wn/$icon@2x.png\" alt=\"Значок погоды\"/>";
    } else {
        echo "Ошибка: " . $weatherData['message'];
    }
}

// Закрытие соединения cURL
curl_close($curl);
?>