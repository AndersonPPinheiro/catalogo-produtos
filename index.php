<?php
session_start();
require_once __DIR__ . '/conexao.php';

/* ============================
   PROCESSO DE LOGIN (MANTEVE)
============================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $_SESSION['error'] = "Credenciais inválidas.";
        header('Location: index.php'); exit;
    }

    $stmt = $mysqli->prepare("SELECT id,nome,senha,role FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $hash, $role);

    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['user'] = [
            'id'=>$id,
            'name'=>$name,
            'email'=>$email,
            'role'=>$role
        ];
        $stmt->close();

        if ($role === 'manager') header('Location: admin/products.php');
        else header('Location: menu.php');
        exit;
    }

    $stmt->close();
    $_SESSION['error'] = "E-mail ou senha inválidos.";
    header('Location: index.php'); exit;
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Doces da Borcelle - Login</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body class="brand-bg">

  <!-- 🔥 BANNER GRANDE EM TODA A LARGURA -->
  <header class="banner-topo">
    <img src="doces_borcelle_project\images\logo.png" 
    class="logo-banner" alt="Doces da Borcelle">
  </header>

  <main class="container main-card">

    <!-- ALERTAS -->
    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-error"><?=htmlspecialchars($_SESSION['error'])?></div>
    <?php unset($_SESSION['error']); endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
      <div class="alert alert-success"><?=htmlspecialchars($_SESSION['success'])?></div>
    <?php unset($_SESSION['success']); endif; ?>

    <section class="hero">

      <div class="hero-left">
        <img src="doces_borcelle_project\images\bolo 3.jpg" alt="Bolo" class="hero-image">
      </div>

      <!-- ⭐ CAIXA CENTRALIZADA -->
      <div class="hero-right center-box">

        <article class="card auth login-box">
          <h2>Entrar</h2>

          <form id="login-form" method="post" novalidate>
            <input type="hidden" name="action" value="login">

            <label>Email
              <input type="email" name="email" required>
            </label>

            <label>Senha
              <input type="password" name="password" minlength="4" required>
            </label>

            <button type="submit" class="btn btn-primary">Entrar</button>

            <p class="link-cadastro">
              Não tem conta?
            </p>

            <!-- 🔥 Botão que vai para nova página -->
            <a href="cadastro.php" class="btn btn-outline btn-full">Cadastre-se aqui</a>

          </form>

        </article>
      </div>

    </section>
  </main>

  <footer class="site-footer">
    <div class="container">© <?=date('Y')?> Doces da Borcelle</div>
  </footer>

</body>
</html>
