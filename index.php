<?php
$page = $_GET['page'] ?? 'fornecedores';

if ($page === 'produtos') {
  require_once __DIR__ . "/views/produtos.php";
} else {
  require_once __DIR__ . "/views/fornecedores.php";
}
