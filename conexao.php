<?php 

    $dbhost = 'LocalHost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'doceria';

    $conexao = new mysqli($dbhost, $dbUsername, $dbPassword, $dbName);

    // if($conexao -> connect_errno) {
    //     echo "Erro!";
    // }
    // else {
    //     echo "Conexão Efetuada!";
    // }

?>