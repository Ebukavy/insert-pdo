<?php
$dsn = "mysql:host=localhost;dbname=winkel";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>Alle producten</h2>";
    $query = "SELECT * FROM Producten";
    $stmt = $db->query($query);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        echo "Product code: " . $row['product_code'] . "<br>";
        echo "Product naam: " . $row['product_naam'] . "<br>";
        echo "Prijs per stuk: " . $row['prijs_per_stuk'] . "<br>";
        echo "Omschrijving: " . $row['omschrijving'] . "<br><br>";
    }

    echo "<h2>Product met product_code 1</h2>";
    $query = "SELECT * FROM Producten WHERE product_code = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([1]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Product code: " . $result['product_code'] . "<br>";
    echo "Product naam: " . $result['product_naam'] . "<br>";
    echo "Prijs per stuk: " . $result['prijs_per_stuk'] . "<br>";
    echo "Omschrijving: " . $result['omschrijving'] . "<br><br>";

    echo "<h2>Product met product_code 2</h2>";
    $query = "SELECT * FROM Producten WHERE product_code = :product_code";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':product_code', 2, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Product code: " . $result['product_code'] . "<br>";
    echo "Product naam: " . $result['product_naam'] . "<br>";
    echo "Prijs per stuk: " . $result['prijs_per_stuk'] . "<br>";
    echo "Omschrijving: " . $result['omschrijving'] . "<br><br>";
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "Error: $error_message";
    exit();
}
?>