# Crud-PHP

Irei explicar cada parte do código para que você compreenda completamente sua funcionalidade. Vamos por partes:

1. PHP - Listagem de itens (index.php)
PHP - Parte Inicial
php
Copiar código
<?php
include('db.php'); // Inclui o arquivo de conexão com o banco de dados (pdo).

// Recuperar os itens do banco de dados
$query = "SELECT * FROM items"; // SQL para buscar todos os registros na tabela 'items'.
$stmt = $pdo->query($query); // Executa o comando SQL.
$items = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém os resultados em formato de array associativo.
?>
Explicação:

include('db.php'): Importa a conexão com o banco de dados para ser usada aqui.
$query: Define o comando SQL para buscar todos os itens.
$pdo->query($query): Executa o comando SQL e retorna um objeto para manipulação de resultados.
fetchAll(PDO::FETCH_ASSOC): Transforma os resultados da consulta em um array onde as colunas da tabela são as chaves.
HTML - Exibição da Página
Cabeçalho e estrutura inicial:
html
Copiar código
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="style.css"> <!-- Importa o arquivo de estilos. -->
</head>
<body>
    <h1>CRUD de Itens</h1>
    <a href="create.php">Adicionar Novo Item</a> <!-- Link para adicionar novos itens -->
Explicação:

HTML básico: Estruturação padrão de uma página.
<meta>: Define codificação de caracteres (UTF-8) e ajusta para dispositivos móveis.
<link rel="stylesheet" href="style.css">: Importa o CSS que define o estilo da página.
<h1>: Exibe o título da página.
<a href="create.php">: Um link para a página de criação de um novo item.
Tabela de exibição dos itens:
html
Copiar código
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($items as $item): ?> <!-- Laço para exibir cada item -->
        <tr>
            <td><?= $item['id'] ?></td> <!-- Exibe o ID -->
            <td><?= $item['name'] ?></td> <!-- Exibe o Nome -->
            <td><?= number_format($item['price'], 2, ',', '.') ?></td> <!-- Exibe o Preço formatado -->
            <td>
                <a href="edit.php?id=<?= $item['id'] ?>">Editar</a> | <!-- Link para editar -->
                <a href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</a> <!-- Link para deletar -->
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
Explicação:

<table>: Cria uma tabela HTML.
<tr> e <th>: Define uma linha de cabeçalho com as colunas ID, Nome, Preço e Ações.
foreach ($items as $item): Percorre cada item obtido do banco de dados.
<?= $item['coluna'] ?>: Exibe o valor de uma coluna específica do item.
number_format($item['price'], 2, ',', '.'): Formata o preço para duas casas decimais, com vírgula e ponto.
Links (Editar/Deletar): Incluem o id do item na URL como parâmetro e permitem ações específicas.
2. PHP - Criar Item (create.php)
PHP - Inserção no Banco
php
Copiar código
<?php
include('db.php'); // Inclui conexão.

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Verifica se o formulário foi enviado.
    $name = $_POST['name']; // Obtém o nome do formulário.
    $price = $_POST['price']; // Obtém o preço do formulário.

    $query = "INSERT INTO items (name, price) VALUES (:name, :price)"; // SQL de inserção.
    $stmt = $pdo->prepare($query); // Prepara a consulta.
    $stmt->execute(['name' => $name, 'price' => $price]); // Executa com os dados enviados.

    header("Location: index.php"); // Redireciona para a página inicial.
}
?>
Explicação:

if ($_SERVER['REQUEST_METHOD'] == 'POST'): Executa o código apenas se o formulário for enviado.
$_POST['name'], $_POST['price']: Captura os valores enviados pelo formulário.
INSERT INTO items: Comando SQL para adicionar dados à tabela items.
prepare e execute: Evitam SQL Injection e enviam os dados.
HTML - Formulário de Criação
html
Copiar código
<form method="POST">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required> <!-- Campo para o nome -->
    <br>
    <label for="price">Preço:</label>
    <input type="text" id="price" name="price" required> <!-- Campo para o preço -->
    <br>
    <button type="submit">Criar</button> <!-- Botão para enviar -->
</form>
<a href="index.php">Voltar</a> <!-- Link para retornar à página inicial -->
3. PHP - Editar Item (edit.php)
PHP - Atualização
php
Copiar código
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // ID do item.
    $name = $_POST['name']; // Novo nome.
    $price = $_POST['price']; // Novo preço.

    $query = "UPDATE items SET name = :name, price = :price WHERE id = :id"; // SQL para atualizar.
    $stmt = $pdo->prepare($query); // Prepara a consulta.
    $stmt->execute(['name' => $name, 'price' => $price, 'id' => $id]); // Executa.
    header("Location: index.php");
}
4. PHP - Deletar Item (delete.php)
php
Copiar código
if (isset($_GET['id'])) { // Verifica se o ID foi enviado.
    $id = $_GET['id']; // Obtém o ID.

    $query = "DELETE FROM items WHERE id = :id"; // SQL para deletar.
    $stmt = $pdo->prepare($query); // Prepara.
    $stmt->execute(['id' => $id]); // Executa.
    header("Location: index.php"); // Redireciona.
}
Explicação:

isset($_GET['id']): Verifica se o ID foi fornecido na URL.
DELETE FROM items: Remove o item do banco.
5. CSS (style.css)
O CSS estiliza os elementos HTML:

Cores e fontes: Torna o visual moderno.
Tabelas e botões: Deixa o layout mais organizado.
Hover effects: Melhora a experiência do usuário.
Agora, você entende cada linha do sistema CRUD! 🎉
