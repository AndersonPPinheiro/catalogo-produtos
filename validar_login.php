<?php 
    // print_r($_REQUEST);

    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // Acessa
        include_once('conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
        $result = $conexao -> query($sql);

        if(mysqli_num_rows($result) < 1) {
            header('Location: login.php');
            
        }
        else {
            header('Location: menu.php');
        }
    }
    else {
        // Não Acessa
        header('Location: login.php');
    }
?>