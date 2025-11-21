<?php
    include('verificar_login.php');

    if ($_SESSION['cargo'] !== 'gerente') {
        echo "<h2>Acesso negado. Apenas gerentes podem usar esta área.</h2>";
        exit();
    }

    include_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Gerenciamento - Doceria PaiD'Égua</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Painel Gerenciamento - Cadastro de Produtos</h2>

    <form action="salvar_produto.php" method="POST" enctype="multipart/form-data" class="register-container">
        <div class="input-group">
            <label>Nome do Produto</label>
            <input type="text" name="nome" required>
        </div>

        <div class="input-group">
            <label>Descrição</label>
            <textarea name="descricao" rows="4" required></textarea>
        </div>

        <div class="input-group">
            <label>Nome do Produto</label>
            <input type="text" name="nome" required>
        </div>
    </form>
</body>
</html>