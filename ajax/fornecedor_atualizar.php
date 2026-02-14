<?php
declare(strict_types=1);
header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/../config/database.php";
$pdo = db();

$id = (int)($_POST['id'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$cnpj = trim($_POST['cnpj'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';

if ($id <= 0 || $nome === '' || $cnpj === '') {
  echo json_encode(["ok" => false, "error" => "Campos obrigatórios inválidos."]);
  exit;
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(["ok" => false, "error" => "E-mail inválido."]);
  exit;
}

$stmt = $pdo->prepare("
  UPDATE fornecedores
  SET nome = :nome, cnpj = :cnpj, email = :email, telefone = :telefone, status = :status
  WHERE id = :id
");

$stmt->execute([
  ":nome" => $nome,
  ":cnpj" => $cnpj,
  ":email" => ($email !== '' ? $email : null),
  ":telefone" => ($telefone !== '' ? $telefone : null),
  ":status" => $status,
  ":id" => $id
]);

echo json_encode(["ok" => true]);
