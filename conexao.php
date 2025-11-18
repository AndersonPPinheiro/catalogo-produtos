<?php
$DB_HOST = '127.0.0.1';
$DB_PORT = 3306;
$DB_USER = 'root';
$DB_PASS = '20041102';
$DB_NAME = 'confeitaria';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
if ($mysqli->connect_errno) {
    die("Falha na conexão MySQL: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
?>