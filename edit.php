<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "UPDATE items SET name = :name, price = :price WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['name' => $name, 'price' => $price, 'id' => $id]);

    header("Location: index.php");
}

$id = $_GET['id'];
$query = "SELECT * FROM items WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Item</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="<?= $item['name'] ?>" required>
        <br>
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" value="<?= $item['price'] ?>" required>
        <br>
        <button type="submit">Atualizar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
