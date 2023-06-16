<?php
$dsn = "mysql:host=localhost;dbname=winkel";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_naam = $_POST['product_naam'];
        $prijs_per_stuk = $_POST['prijs_per_stuk'];
        $omschrijving = $_POST['omschrijving'];

        $query = "INSERT INTO Producten (product_naam, prijs_per_stuk, omschrijving) 
                  VALUES (:product_naam, :prijs_per_stuk, :omschrijving)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':product_naam', $product_naam);
        $stmt->bindParam(':prijs_per_stuk', $prijs_per_stuk);
        $stmt->bindParam(':omschrijving', $omschrijving);
        $stmt->execute();

        echo "Product toegevoegd: $product_naam, Prijs per stuk: $prijs_per_stuk, Omschrijving: $omschrijving <br>";
    }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "Error: $error_message";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Toevoegen</title>
</head>
<body>
    <h2>Product Toevoegen</h2>
    <form method="POST" action="insert.php">
        <label for="product_naam">Product Naam:</label>
        <input type="text" name="product_naam" id="product_naam" required><br>

        <label for="prijs_per_stuk">Prijs per stuk:</label>
        <input type="number" step="0.01" name="prijs_per_stuk" id="prijs_per_stuk" required><br>

        <label for="omschrijving">Omschrijving:</label>
        <input type="text" name="omschrijving" id="omschrijving" required><br>

        <button type="submit">Voeg Product Toe</button>
    </form>
</body>
</html>