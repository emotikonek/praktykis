<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formularz</title>
</head>
<body>
<form action="formularz.php" method="post" enctype="multipart/form-data">
    <label for="name">Imię:</label><br>
    <input type="text" id="imie" name="imie"><br>

    <label for="surname">Nazwisko:</label><br>
    <input type="text" id="nazwisko" name="nazwisko"><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email"><br>

    <label for="phone">Numer telefonu:</label><br>
    <input type="tel" id="telefon" name="telefon"><br>

    <label for="img">Dodaj zdjęcie</label> 
    <input type="file" name="file" id="file"><br>

    <input type="submit" value="wyślij"> <br>
</form>
</body>
</html>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'dane');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST['imie'] ?? '';
    $nazwisko = $_POST['nazwisko'] ?? '';
    $email = $_POST['email'] ?? '';
    $nr_tel = $_POST['telefon'] ?? '';
    
    // Przetwarzanie przesłanego pliku
    $img = ''; // Inicjalizacja zmiennej, w której będzie przechowywana ścieżka do pliku
    if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $target_dir = "uploads/"; // Folder, do którego będą zapisywane przesłane pliki
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $img = $target_file; // Ustawienie ścieżki do pliku w zmiennej $img
        } else {
            echo "Wystąpił błąd podczas przesyłania pliku.";
        }
    }

    if (empty($imie) || empty($nazwisko) || empty($email) || empty($nr_tel)) {
        echo "Proszę wypełnić wszystkie dane.<br>";
    } else {
        $sql = "INSERT INTO kontakt (imie, nazwisko, email, telefon, img) VALUES ('$imie', '$nazwisko', '$email', '$nr_tel', '$img')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            echo "Dane zostały dodane poprawnie";
        } else {
            echo "Błąd: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>


</body>
</html>