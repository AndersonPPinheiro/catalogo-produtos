<?php
session_start();
require_once __DIR__ . '/../conexao.php';
if (empty($_SESSION['user']) || $_SESSION['user']['role'] !== 'manager') {
    header('Location: ../index.php'); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $idToDelete = intval($_POST['id']);
    $stmt = $mysqli->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $idToDelete);
    $stmt->execute();
    $stmt->close();
}
header('Location: products.php'); exit;
