<?php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$stmt = $conn->prepare("SELECT * FROM items");
$stmt->execute();
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/script.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>CRUD</h2>
        <div class="search-container">
            <input type="text" id="search" placeholder="Pesquisar por itens...">
            <button id="searchButton"> <img src="../svg/search_24dp_FILL0_wght400_GRAD0_opsz24.svg" alt="pesquisar"></button>
        </div>
        <a class="create" href="create.html"><img src="../svg/add_circle_24dp_FILL0_wght400_GRAD0_opsz24.svg" alt="adicionar"></a>
        
        <table border="1" id="itemsTable">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td>
                
                    <a href="update.php?id=<?php echo $item['id']; ?>"><img src="../svg/edit_square_24dp_FILL0_wght400_GRAD0_opsz24.svg" alt="editar"></a>
                    <a href="delete.php?id=<?php echo $item['id']; ?>" class="delete"><img src="../svg/delete_24dp_FILL0_wght400_GRAD0_opsz24.svg" alt="deletar"></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

