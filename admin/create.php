<?php
session_start();
require_once __DIR__ . '/../conexao.php';
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'manager') {
    header('Location: ../index.php'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $image = trim($_POST['image'] ?? 'images/default.jpg');
    if ($title === '' || $price <= 0) {
        $error = "Título e preço válidos são obrigatórios.";
    } else {
        $stmt = $mysqli->prepare("INSERT INTO produtos (title,description,price,image) VALUES (?,?,?,?)");
        $stmt->bind_param("ssds", $title, $desc, $price, $image);
        $stmt->execute();
        $stmt->close();
        header('Location: products.php'); exit;
    }
}
?>
<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Criar Produto</title>
<link rel="stylesheet" href="../css/styles.css"></head>
<body>
  <header class="site-header"><div class="container"><h1>Criar Produto</h1></div></header>
  <main class="container">
    <?php if (!empty($error)): ?><div class="alert alert-error"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="post" id="product-create-form" novalidate>
      <label>Título<input name="title" required></label>
      <label>Descrição<textarea name="description"></textarea></label>
      <label>Preço<input name="price" type="number" step="0.01" required></label>
      <label>Imagem (caminho relativo)<input name="image" value="images/bolo1.jpg"></label>
      <button class="btn" type="submit">Salvar</button><a href="products.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </main>
  <script src="../js/app.js"></script>
</body>
</html>
