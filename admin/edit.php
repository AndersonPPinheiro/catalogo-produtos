<?php
session_start();
require_once __DIR__ . '/../conexao.php';
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'manager') {
    header('Location: ../index.php'); exit;
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $mysqli->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$res = $stmt->get_result();
$product = $res->fetch_assoc();
$stmt->close();
if (!$product) { header('Location: products.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['description'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $image = trim($_POST['image'] ?? 'images/default.jpg');
    if ($title === '' || $price <= 0) {$error="Título e preço válidos são obrigatórios.";}
    else {
        $stmt = $mysqli->prepare("UPDATE produtos SET title=?, description=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("ssdsi",$title,$desc,$price,$image,$id);
        $stmt->execute();
        $stmt->close();
        header('Location: products.php'); exit;
    }
}
?>
<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Editar Produto</title>
<link rel="stylesheet" href="../css/styles.css"></head>
<body>
  <header class="site-header"><div class="container"><h1>Editar Produto</h1></div></header>
  <main class="container">
    <?php if (!empty($error)): ?><div class="alert alert-error"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="post" id="product-edit-form" novalidate>
      <label>Título<input name="title" value="<?=htmlspecialchars($product['title'])?>" required></label>
      <label>Descrição<textarea name="description"><?=htmlspecialchars($product['description'])?></textarea></label>
      <label>Preço<input name="price" type="number" step="0.01" value="<?=htmlspecialchars($product['price'])?>" required></label>
      <label>Imagem (caminho relativo)<input name="image" value="<?=htmlspecialchars($product['image'])?>"></label>
      <button class="btn" type="submit">Salvar</button><a href="products.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </main>
  <script src="../js/app.js"></script>
</body>
</html>
