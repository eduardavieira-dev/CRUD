<?php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE items SET name = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $id]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Atualizar</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/script.js" defer></script>
</head>
<body>
<div class="container">
<a href="index.php">Voltar</a>
    <h2>Atualize o item</h2>
    <div class="container2">
    <form method="post">
    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="<?php echo $item['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required><?php echo $item['description']; ?></textarea><br>
    </div>
    <div class="form-group">
        <label for="price">Preço:</label>
        <input type="text" id="price" name="price" value="<?php echo $item['price']; ?>" required>
    </div>
        <button type="submit">Atualizar</button>
    </form>
</div>
</div>
</body>
</html>
