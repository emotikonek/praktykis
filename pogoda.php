<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>


<!-- e719de05a990ab676288b93baa4e8fab -->
<?php

$city = "London"; 
$api_key = "e719de05a990ab676288b93baa4e8fab";
$url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $api_key;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

$weather_data = json_decode($response, true);

$temperature = $weather_data['main']['temp'];
$temperature_in_celcius = round($temperature - 273.15);

$feels_like = $weather_data['main']['feels_like'];
$feels_like_in_celcius = round($feels_like - 273.15);

$humidity = $weather_data['main']['humidity'];
$windspeed = $weather_data['wind']['speed'];

$temperature_current_weather_ = $weather_data['weather'][0]['main'];
$temperature_current_weather_description = $weather_data['weather'][0]['description'];
$temperature_current_weather_icon = $weather_data['weather'][0]['icon'];

$data=date("Y-m-d");
$czas=date("H:i");

echo "<h2>Pogoda na dzień $data i godzinę $czas</h2>";
echo "</br>";
echo "Temperatura w Londynie wynosi: " . $temperature_in_celcius . " stopni Celsjusza.";
echo "</br>";
echo "Temperatura odczuwalna:" .$feels_like_in_celcius . " stopni Celsjusza.";
echo "</br>";
echo "wilgotność wynosi: $humidity ";
echo "</br>";
echo "szybkość wiatru: " . $windspeed . "km/h";
echo "</br>";
echo "Aktualna pogoda: $temperature_current_weather_";
echo "</br>";
echo "Opis aktualnej pogody: $temperature_current_weather_description";
echo "</br>";
echo "ikona pogody: <img src='http://openweathermap.org/img/wn/" .$temperature_current_weather_icon."@2x.png' />";
echo "</br>";

echo "<pre>";
print_r($weather_data); 
?>
