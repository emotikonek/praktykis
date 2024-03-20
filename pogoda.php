<?php
$api_key = "e719de05a990ab676288b93baa4e8fab";
$error = ""; 
$weather = ""; 

if (array_key_exists('submit', $_GET)) {
    if (!$_GET['city']) {
        $error = 'pole jest puste';
    }
    if ($_GET['city']) {
        $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=" . $_GET['city'] . "&appid=" . $api_key);
        $weatherArray = json_decode($apiData, true);
        $temperature = $weatherArray['main']['temp'];
        $temperature_in_celcius = round($temperature - 273.15);
        $sunrise = $weatherArray['sys']['sunrise'];


        if (isset($weatherArray['weather']) && !empty($weatherArray['weather'])) {

            $tempCelsius = $weatherArray['main']['temp'] - 273;
            $weather ="<b>".$weatherArray['name'].", ".$weatherArray['sys']['country']." : ".round($tempCelsius). "°C" ."</b> <br>";
            $weather .= "<b>Weather Condition: </b>" .$weatherArray['weather']['0'] ['description']."<br>";
            $weather .= "<b>Atmosperic Pressure: </b>" .$weatherArray['main']['pressure']. "hPa<br>";
            $weather .= "<b>Wind Speed: </b>".$weatherArray['wind']['speed']."meter/sec<br> ";
            $weather .= "<b>Cloudness: </b>" .$weatherArray['clouds']['all']." % <br>"; 
            $weather .= "<b>Sunrise: </b>" . date("g:i a", $sunrise) . "<br>";
            $weather .= "<b>Current Time: </b>" . date("F j, Y, g:i a");
        } else {
            $error = "Nie ud    ło się pobrać danych pogodowych dla podanego miasta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogoda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="csspogoda.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <div class="container">
        <h1>Wyszukaj pogodę</h1>
        <form action="" method="GET">
            <p><label for="city">wprowadź swoje miasto</label></p>
            <p><input type="text" name="city" id="city" placeholder="City Name"></p>
            <button type="submit" name="submit" class="btn btn-success">Wyślij</button> 
            <div class="output mt-3">

                <?php
                if ($weather) {
                    echo '<div class="alert alert-success" role="alert">' . $weather .'</br>' . '</div>';
                } 
                if ($error) {
                    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                }
                ?>
            </div>
        </form>
    </div>
</body>
</html>
