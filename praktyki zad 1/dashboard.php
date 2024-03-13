<?php
session_start();


$conn = mysqli_connect('localhost', 'root', '', 'dane');

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {

    header("Location: log.php");
    exit();
}

$user_id = $_SESSION['user_id']; 

// Pobranie informacji o zalogowanym użytkowniku z bazy danych
$user_query = "SELECT * FROM logowanie WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result || mysqli_num_rows($user_result) == 0) {
    die("Błąd: Brak danych użytkownika.");
}

$user_data = mysqli_fetch_assoc($user_result);
$powitanie = "Witaj {$user_data['logowanie']}! To jest twój panel kontrolny.";


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h2>Panel kontrolny</h2>
<p><?php echo $powitanie; ?></p>


</body>
</html>
