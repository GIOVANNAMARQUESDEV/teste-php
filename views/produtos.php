<?php
require_once __DIR__ . "/../config/database.php";
$pdo = db();

$produtos = $pdo->query("SELECT * FROM produtos ORDER BY id DESC")->fetchAll();
?>

<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/app.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body class="page-produtos">
  <div class="container">
    <p class="hint">
 <a href="/TESTE-PHP/?page=fornecedores">Fornecedores</a>
<a href="/TESTE-PHP/?page=produtos">Produtos</a>

</p>

    <h1>Produtos</h1>

    <div id="toast" class="toast" style="display:none;"></div>

    <div class="card">
      <h2>Novo produto</h2>

      <form id="formProduto">
        <div class="grid">
          <label>
            Nome*
            <input type="text" name="nome" required>
          </label>

          <label>
            Código interno
            <input type="text" name="codigo_interno" placeholder="Ex: PRD-001">
          </label>

          <label style="grid-column: 1 / -1;">
            Descrição
            <textarea name="descricao" rows="3" placeholder="Descreva o produto..."></textarea>
          </label>

          <label>
            Status
            <select name="status">
              <option value="ativo" selected>Ativo</option>
              <option value="inativo">Inativo</option>
            </select>
          </label>
        </div>

        <button type="submit">Salvar</button>
      </form>
      <small>* campo obrigatório</small>
    </div>

    <div class="card">
      <h2>Lista</h2>

      <input id="buscaProduto" class="search" placeholder="Buscar por nome, código, status...">

      <table class="table" id="tabelaProdutos">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Código</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produtos as $p): ?>
            <tr>
              <td><?= (int)$p['id'] ?></td>
              <td><?= htmlspecialchars($p['nome']) ?></td>
              <td><?= htmlspecialchars($p['codigo_interno'] ?? '') ?></td>
              <td>
                <span class="pill <?= $p['status'] === 'ativo' ? 'ok' : 'off' ?>">
                  <?= htmlspecialchars($p['status']) ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <p class="hint">
    </p>
  </div>

  <script src="assets/js/produtos.js"></script>
</body>
</html>
