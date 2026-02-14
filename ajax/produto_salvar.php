<?php
declare(strict_types=1);
header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/../config/database.php";
$pdo = db();

$nome = trim($_POST['nome'] ?? '');
$codigo = trim($_POST['codigo_interno'] ?? '');
$descricao = trim($_POST['descricao'] ?? '');
$status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';

if ($nome === '') {
  echo json_encode(["ok" => false, "error" => "Nome obrigatório"]);
  exit;
}

$stmt = $pdo->prepare("
  INSERT INTO produtos (nome, codigo_interno, descricao, status)
  VALUES (:nome, :codigo, :descricao, :status)
");

$stmt->execute([
  ":nome" => $nome,
  ":codigo" => ($codigo !== '' ? $codigo : null),
  ":descricao" => ($descricao !== '' ? $descricao : null),
  ":status" => $status
]);

echo json_encode(["ok" => true]);
