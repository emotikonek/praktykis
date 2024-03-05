<?php
$conn = mysqli_connect('localhost', 'root', '', 'dane');

if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit'])) {
        $id = $_POST['edit'];
        
        $edit_query = mysqli_query($conn, "SELECT * FROM kontakt WHERE id='$id'");
        $edit_row = mysqli_fetch_array($edit_query);
        
        echo "<form method='post' action='{$_SERVER['PHP_SELF']}'>";
        echo "<input type='hidden' name='id' value='{$edit_row['id']}'>";
        echo "Imię: <input type='text' name='imie' value='{$edit_row['imie']}'><br>";
        echo "Nazwisko: <input type='text' name='nazwisko' value='{$edit_row['nazwisko']}'><br>";
        echo "Email: <input type='email' name='email' value='{$edit_row['email']}'><br>";
        echo "Numer telefonu: <input type='text' name='telefon' value='{$edit_row['telefon']}'><br>";
        echo "<button type='submit' name='update'>Zapisz zmiany</button>";
        echo "</form>";
    } if((isset($_POST['update']))) {
        
        $rowID = $_POST['id'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $email = $_POST['email'];
        $telefon = $_POST['telefon'];
        var_dump($_POST);

        $sql = "UPDATE kontakt SET imie='$imie', nazwisko='$nazwisko', email='$email', telefon='$telefon' WHERE id='$rowID'";
        mysqli_query($conn, $sql);
        if (!mysqli_query($conn, $sql)) {
            echo "Błąd podczas aktualizacji wpisu: " . mysqli_error($conn);
        } else {
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
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
    <title>Edycja wpisu</title>
</head>
<body>
    
    <h1>Edycja wpisu</h1>
    <table border="1">
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Email</th>
            <th>Numer telefonu</th>
            <th>ID</th>
            <th>Edytuj</th>
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
                <input type="hidden" name="edit" value="<?= $row['id'] ?>">
                <button type="submit" name="submit">Edytuj</button>
            </form>
        </td>
    </tr>
<?php endwhile; ?>

    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
