<?php
session_start();
require_once __DIR__ . '/../conexao.php';
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'manager') {
    header('Location: ../index.php'); exit;
}
$res = $mysqli->query("SELECT * FROM produtos ORDER BY id DESC");
$products = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin - Produtos</title>
<link rel="stylesheet" href="../css/styles.css"></head>
<body>
  <header class="site-header"><div class="container"><h1>Painel Gerente</h1>
  <div class="admin-actions"><a class="btn" href="create.php">Criar Produto</a><a class="btn btn-secondary" href="../index.php">Sair</a></div></div></header>

  <main class="container">
    <h2>Produtos</h2>
    <?php if (empty($products)): ?>
      <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
      <div class="product-grid">
      <?php foreach ($products as $p): ?>
        <div class="product-card">
          <img src="../<?=htmlspecialchars($p['image'])?>" alt="<?=htmlspecialchars($p['title'])?>">
          <h3><?=htmlspecialchars($p['title'])?></h3>
          <p class="desc"><?=htmlspecialchars($p['description'])?></p>
          <p class="price">R$ <?=number_format($p['price'],2,',','.')?></p>
          <div class="product-actions">
            <a class="btn" href="edit.php?id=<?=urlencode($p['id'])?>">Editar</a>
            <form style="display:inline" method="post" action="delete.php" onsubmit="return confirm('Excluir este produto?')">
              <input type="hidden" name="id" value="<?=htmlspecialchars($p['id'])?>">
              <button class="btn btn-danger" type="submit">Excluir</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </main>
  <script src="../js/app.js"></script>
</body>
</html>
