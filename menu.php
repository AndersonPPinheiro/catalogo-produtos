<?php
session_start();
require_once __DIR__ . '/conexao.php';
if (empty($_SESSION['user'])) { header('Location: index.php'); exit; }
$res = $mysqli->query("SELECT * FROM produtos ORDER BY id DESC");
$products = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>
<!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Cardápio - Doces da Borcelle</title>
<link rel="stylesheet" href="css/styles.css"></head>
<body class="brand-bg">
  <header class="site-header brand-header">
    <div class="container header-inner">
      <img src="doces_borcelle_project\images\logo.png" alt="Doces da Borcelle" class="logo-banner">
      <div class="header-right">
        <span class="hello">Olá, <?=htmlspecialchars($_SESSION['user']['name'])?></span>
        <a class="btn btn-secondary" href="index.php">Sair</a>
      </div>
    </div>
  </header>

  <main class="container">
    <section class="product-grid">
      <?php foreach ($products as $p): ?>
        <article class="product-card">
          <img src="<?=htmlspecialchars($p['image'])?>" alt="<?=htmlspecialchars($p['title'])?>">
          <h3><?=htmlspecialchars($p['title'])?></h3>
          <p class="desc"><?=htmlspecialchars($p['description'])?></p>
          <p class="price">R$ <?=number_format($p['price'],2,',','.')?></p>
          <button class="btn buy-btn" data-id="<?=htmlspecialchars($p['id'])?>">Compre agora</button>
        </article>
      <?php endforeach; ?>
    </section>
  </main>

  <footer class="site-footer"><div class="container">© <?=date('Y')?> Confeitaria</div></footer>
  <script src="js/app.js"></script>
</body>
</html>
