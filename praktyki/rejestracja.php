<!DOCTYPE html>
<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'dane');

if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');
    
    if (empty($username) || empty($password)) {
        echo "Proszę wypełnić wszystkie dane.<br>";
    } else {
        // Sprawdzanie czy login już istnieje
        $check_query = "SELECT * FROM logowanie WHERE logowanie='$username'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            echo "Podany login już istnieje.<br>";
        } else {
            // Dodawanie nowego rekordu do bazy danych
            $sql = "INSERT INTO logowanie (logowanie, haslo) VALUES ('$username', '$password')";
            $query = mysqli_query($conn, $sql);
            
            if ($query) {
                echo "Dane zostały dodane poprawnie";
                echo "Teraz możesz się zalogować używając tego linku:";
                $url = "logowanie.php";
                echo "<a href='$url'>Logowanie</a>";
            } else {
                echo "Błąd: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>

<html>
<head>
    <title>Rejestracja</title>
</head>
<body>

<h2>Rejestracja</h2>
<form method="post" action="rejestracja.php">
    <label for="username">Login:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" name="register" value="Zarejestruj">
</form>

</body>
</html>
