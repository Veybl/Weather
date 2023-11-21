<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <title>Погода</title>
</head>
<body>
    <div class="container">
        <?php
        require 'vendor/autoload.php'; 

        use GuzzleHttp\Client;

        $client = new Client();

        $jsonApiUrl = 'https://api.openweathermap.org/data/2.5/weather?q=Chernihiv&appid=d06baf7900ee0eb67d4d45ac1c54c727';

        try {
            $response = $client->get($jsonApiUrl);

            $data = $response->getBody()->getContents();

            $jsonData = json_decode($data);

            if ($jsonData) {
                echo '<h1>Погода у ' . $jsonData->name . '</h1>';
                echo '<p>Температура: ' . $jsonData->main->temp - 273.15 . '°C</p>';
                echo '<p>Вологість: ' . $jsonData->main->humidity . '%</p>';
                echo '<p>Тиск: ' . $jsonData->main->pressure . ' гПа</p>';
            } else {
                echo 'Помилка отримання даних з API.';
            }
        } catch (Exception $e) {
            echo 'Помилка: ' . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>