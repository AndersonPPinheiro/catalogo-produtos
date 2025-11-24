<?php
include("../verificar_login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pagamento com Cartão</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="card-container">
        <h2>Pagamento com Cartão</h2>

        <form action="finalizar_pedido.php" method="POST" class="card-form">
            <input type="hidden" name="pagamento" value="cartao">

            <label>Número do cartão</label>
            <input type="text" maxlength="19" placeholder="0000 0000 0000 0000" required>

            <label>Validade</label>
            <input type="text" placeholder="MM/AA" maxlength="5" required>

            <label>CVV</label>
            <input type="password" maxlength="3" required>

            <button class="btn-fake-paid" type="submit">Pagar Agora</button>
        </form>
    </main>
</body>
</html>
