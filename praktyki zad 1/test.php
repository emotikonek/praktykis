<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'dane');

if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}


echo "Witaj na stronie logowania!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');
    
    // Zapytanie do bazy danych w celu weryfikacji danych logowania
    $login_query = "SELECT * FROM logowanie WHERE logowanie='$username'";
    $login_result = mysqli_query($conn, $login_query);
    
    // Sprawdzenie czy użytkownik istnieje
    if (mysqli_num_rows($login_result) == 1) {
        $user_data = mysqli_fetch_assoc($login_result);
        // Sprawdzenie czy hasło jest poprawne
        if ($user_data['haslo'] == $password) {
            // Ustawienie sesji
            $_SESSION['username'] = $username;
            // Przekierowanie do strony użytkownika
            header("Location: user_page.php");
            exit(); // Zakończenie działania kodu po przekierowaniu
        } else {
            // Komunikat o błędnym haśle
            echo "Błędne hasło.";
        }
    } else {
        // Komunikat o braku użytkownika
        echo "Brak użytkownika o podanym loginie.";
    }
}

// Zamykanie połączenia z bazą danych
mysqli_close($conn);
?>
