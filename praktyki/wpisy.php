<?php

$conn = mysqli_connect('localhost', 'root', '', 'dane');

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}


$result = mysqli_query($conn, "SELECT * FROM kontakt");
if (!$result) {
    die("Błąd pobierania danych z bazy danych: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wpisy</title>
</head>
<body>
    
    <h1>Wpisy z bazy danych:</h1>
    <table border="1">
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Numer telefonu</th>
            <th>ID</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)): ?>
    <tr>
        <td><?= $row['imie'] ?></td>
        <td><?= $row['nazwisko'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['telefon'] ?></td>
        <td><?= $row['id'] ?></td>
    </tr>
<?php endwhile; ?>

    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
