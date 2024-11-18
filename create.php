<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "INSERT INTO items (name, price) VALUES (:name, :price)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['name' => $name, 'price' => $price]);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Criar Novo Item</h1>
    <form method="POST">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" required>
        <br>
        <button type="submit">Criar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
