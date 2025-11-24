<?php
include("../verificar_login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pagamento em Dinheiro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="cash-container">
        <h2>Pagamento na Entrega</h2>

        <p>Você pagará ao entregador quando o pedido chegar.</p>

        <a class="btn-fake-paid" href="finalizar_pedido.php?pagamento=dinheiro">
            Confirmar Pedido
        </a>
    </main>
</body>
</html>
