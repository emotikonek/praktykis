<?php
$connection = new mysqli('localhost', 'root', '', 'sklep');

if ($connection->connect_error) {
    die("Błąd połączenia z bazą danych: " . $connection->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST['nazwa'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];

    if (isset($_FILES['zdjecie']) && $_FILES['zdjecie']['error'] === UPLOAD_ERR_OK) {
  
        $tempFile = $_FILES['zdjecie']['tmp_name'];

        $newFileName = uniqid() . '_' . $_FILES['zdjecie']['name'];

        $targetFile = "uploads/" . $newFileName;


        if (move_uploaded_file($tempFile, $targetFile)) {

            $query = "INSERT INTO produkty (nazwa, opis, zdjecie, cena) VALUES ('$nazwa', '$opis', '$targetFile', '$cena')";
            
            if ($connection->query($query) === TRUE) {
                echo "Produkt został dodany!";
            } else {
                echo "Błąd podczas dodawania produktu: " . $connection->error;
            }
        } else {
            echo "Błąd podczas przesyłania pliku!";
        }
    } else {
        echo "Nie udało się przesłać pliku!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodawanie produktu</title>
</head>
<body>
    <h2>Dodaj nowy produkt</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        Nazwa: <input type="text" name="nazwa"><br>
        Opis: <textarea name="opis"></textarea><br>
        Zdjęcie: <input type="file" name="zdjecie"><br>
        Cena: <input type="text" name="cena"><br>
        <input type="submit" value="Dodaj produkt">
    </form>

    <a href="index.php">powrót na stronę główną</a>
</body>
</html>
