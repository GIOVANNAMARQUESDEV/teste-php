<?php
declare(strict_types=1);
header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/../config/database.php";
$pdo = db();

$nome = trim($_POST['nome'] ?? '');
$cnpj = trim($_POST['cnpj'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$status = ($_POST['status'] ?? 'ativo') === 'inativo' ? 'inativo' : 'ativo';

// validação básica
if ($nome === '' || $cnpj === '') {
  echo json_encode(["ok" => false, "error" => "Nome e CNPJ são obrigatórios."]);
  exit;
}
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(["ok" => false, "error" => "E-mail inválido."]);
  exit;
}

try {
  $stmt = $pdo->prepare("
    INSERT INTO fornecedores (nome, cnpj, email, telefone, status)
    VALUES (:nome, :cnpj, :email, :telefone, :status)
  ");
  $stmt->execute([
    ":nome" => $nome,
    ":cnpj" => $cnpj,
    ":email" => ($email !== '' ? $email : null),
    ":telefone" => ($telefone !== '' ? $telefone : null),
    ":status" => $status
  ]);

  echo json_encode(["ok" => true]);
} catch (Throwable $e) {
  echo json_encode(["ok" => false, "error" => "Erro no banco."]);
}
