<?php
session_start();
require_once __DIR__ . '/conexao.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Cadastro - Doces da Borcelle</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body class="brand-bg">

<header class="header-full">
  <img src="images/logo.png" class="logo-banner" alt="Doces da Borcelle">
</header>

<main class="container">
    <article class="card" style="max-width:450px;margin:0 auto;margin-top:20px;">
        <h2>Criar Conta</h2>

        <?php if (!empty($_SESSION['error'])): ?>
          <div class="alert alert-error"><?=htmlspecialchars($_SESSION['error'])?></div>
        <?php unset($_SESSION['error']); endif; ?>

        <form method="post" action="index.php" novalidate>
            <input type="hidden" name="action" value="register">

            <label>Nome
              <input type="text" name="name" required>
            </label>

            <label>Email
              <input type="email" name="email" required>
            </label>

            <label>Senha
              <input type="password" name="password" minlength="4" required>
            </label>

            <label>Tipo de Conta
              <select name="role">
                <option value="client">Cliente</option>
                <option value="manager">Gerente</option>
              </select>
            </label>

            <button type="submit" class="btn btn-secondary" style="margin-top:12px;">Cadastrar</button>

            <p class="link-cadastro">
                Já tem conta? <a href="index.php">Entrar</a>
            </p>
        </form>
    </article>
</main>

</body>
</html>
