<?php

$connection = new mysqli('localhost', 'root', '', 'sklep');

if ($connection->connect_error) {
    die("Błąd połączenia z bazą danych: " . $connection->connect_error);
}

$query = "SELECT * FROM produkty";
$result = $connection->query($query);

$products = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "Brak produktów w bazie danych.";
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Internetowy</title>
    <link rel="stylesheet" href="cssindex.css">

</head>
<body>
    <header>
        <h1>Sklep Internetowy</h1>

    </header>
    <main>
        <section class="products">
            <h2>Nasze produkty</h2>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    
                        <h3><?php echo $product['nazwa']; ?></h3>
                        <p>Cena: <?php echo $product['cena']; ?> PLN</p>
                        <a href="product.php">
                        <img src="<?php echo $product['zdjecie']; ?>" alt="Zdjęcie produktu">
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Sklep Internetowy</p>
    </footer>
</body>
</html>



