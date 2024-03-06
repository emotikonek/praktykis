<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'dane');
if (!$conn) {
    die("Błąd połączenia: " . mysqli_connect_error());
}

// Logowanie użytkownika
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $login_query = "SELECT * FROM logowanie WHERE logowanie='$username' AND haslo='$password'";
    $login_result = mysqli_query($conn, $login_query);
    if (mysqli_num_rows($login_result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.html");
        exit(); // Dodane, aby zapobiec kontynuacji wykonywania kodu po przekierowaniu
    } else {
        echo "Błędne dane logowania.";
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

</body>
</html>
