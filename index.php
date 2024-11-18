<?php
include('db.php');

// Recuperar os itens do banco de dados
$query = "SELECT * FROM items";
$stmt = $pdo->query($query);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>CRUD de Itens</h1>
    <a href="create.php">Adicionar Novo Item</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= number_format($item['price'], 2, ',', '.') ?></td>
            <td>
                <a href="edit.php?id=<?= $item['id'] ?>">Editar</a> | 
                <a href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
