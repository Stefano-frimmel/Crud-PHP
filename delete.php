<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM items WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    header("Location: index.php");
}
?>
