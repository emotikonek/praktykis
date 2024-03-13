<?php

$conn = mysqli_connect('localhost', 'root', '', 'dane');

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['delete'])) {
    $id = $_POST['delete'];

    $sql = "DELETE FROM kontakt WHERE id='$id'";
    if (!mysqli_query($conn, $sql)) {
        echo "Błąd podczas usuwania wpisu: " . mysqli_error($conn);
    } else {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
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
    <title>usuwanie</title>
</head>
<body>
    
    <h1>usuwanie</h1>
    <table border="1">
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Numer telefonu</th>
            <th>ID</th>
            <th>Usuń</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)): ?>
    <tr>
        <td><?= $row['imie'] ?></td>
        <td><?= $row['nazwisko'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['telefon'] ?></td>
        <td><?= $row['id'] ?></td>
        <td>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="delete" value="<?= $row['id'] ?>">
                <button type="submit" name="submit">Usuń</button>
            </form>
        </td>
 
    </tr>
<?php endwhile; ?>

    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
