<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>losowe zdjęcia kaczek</title>
</head>
<body>
    <h1>Super Mega Słodkie zdjęcia kaczek</h1>
    <?php
    function losowezdjecie() {
        $url = 'https://random-d.uk/api/v2/random';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        return $data['url'] ?? null;
    }

    $Image = isset($_POST['new']) ? losowezdjecie() : losowezdjecie();

    if ($Image) {
        echo '<img src="' . $Image . '" alt="losowe zdjęcie">';
    } else {
        echo 'nie udało się wyświetlić zdjęcia kaczki';
    }
    ?>

    <form method="post">
        <button type="submit" name="new">nowe zdjęcie</button>
    </form>

    <style>
        img {
            max-width: 350px;
            max-height: 400px;
        }
    </style>
</body>
</html>
