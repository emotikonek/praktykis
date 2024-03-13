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
    
    
    $login_query = "SELECT * FROM logowanie WHERE logowanie='$username'";
    $login_result = mysqli_query($conn, $login_query);
    
    
    if (mysqli_num_rows($login_result) == 1) {
        $user_data = mysqli_fetch_assoc($login_result);
        
        if ($user_data['haslo'] == $password) {
            // Ustawienie sesji
            $_SESSION['user_id'] = $user_data['id']; 
         
            header("Location: dashboard.php");
            exit(); 
        } else {
            
            echo "Błędne hasło.";
        }
    } else {
        
        echo "Brak użytkownika o podanym loginie.";
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logowanie</title>
</head>
<body>

<h2>Logowanie</h2>
<form method="post" action="logowanie.php">
    <label for="username">Login:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Hasło:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" name="login" value="Zaloguj">
</form>
<p>Nie masz konta? Stworz je!</p>
<a href="rejestracja.php" class="rej">Stwórz konto</a> <br>
    <br>
</body>
</html>
