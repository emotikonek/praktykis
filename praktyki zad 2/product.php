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

function addToCart($product_id, $dostepnosc) {
    echo "Dodano produkt do koszyka: Produkt ID: $product_id, Ilość: $dostepnosc";

}

if (isset($_POST['add_to_cart'])) {
    $product_id = isset($_POST['id_produktu']) ? $_POST['id_produktu'] : null;
    $dostepnosc = isset($_POST['dostepnosc']) ? $_POST['dostepnosc'] : null;

    if ($product_id !== null && $dostepnosc !== null) {
        addToCart($product_id, $dostepnosc);
    } else {
        echo "Błąd podczas przetwarzania danych z formularza.";
    }
}
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
                <form method="post">
                        <h3><?php echo $product['nazwa']; ?></h3>
                        <p>Cena: <?php echo $product['cena']; ?> PLN</p>
                        <img src="<?php echo $product['zdjecie']; ?>" alt="Zdjęcie produktu">
                        <p class="description">Opis: <?php echo $product['opis']; ?></p>
                        <p>Dostępność: <?php echo $product['dostepnosc']; ?> sztuk</p>
                        <label for="dostepnosc<?php echo $product['id_produktu']; ?>">Ilość:</label>
                            <input type="number" id="dostepnosc<?php echo $product['id_produktu']; ?>" name="dostepnosc" min="1" max="<?php echo $product['dostepnosc']; ?>" value="1">
                            <input type="submit" value="Dodaj do koszyka" name="add_to_cart">
                        </a>
                </div>
            <?php endforeach; ?>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Sklep Internetowy</p>
    </footer>
</body>
</html>


