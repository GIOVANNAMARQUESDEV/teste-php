<?php
require_once __DIR__ . "/views/fornecedores.php";
$pdo = db();

$fornecedores = $pdo->query("SELECT * FROM fornecedores ORDER BY id DESC")->fetchAll();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title> Fornecedores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/app.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="page-fornecedores">

  <div class="container">
    <h1> Fornecedores</h1>
    <p class="hint">
 <a href="/TESTE-PHP/?page=fornecedores">Fornecedores</a>
<a href="/TESTE-PHP/?page=produtos">Produtos</a>

</p>

    <div id="toast" class="toast" style="display:none;"></div>

    <div class="card">
      <h2> Novo fornecedor </h2>

      <form id="formFornecedor">
        <div class="grid">
          <label>
            Nome*
            <input type="text" name="nome" required>
          </label>

          <label>
            CNPJ*
            <input type="text" name="cnpj" required>
          </label>

          <label>
            E-mail
            <input type="email" name="email">
          </label>

          <label>
            Telefone
            <input type="text" name="telefone">
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
      <small>* campos obrigatórios</small>
    </div>

    <div class="card">
      <h2>Lista</h2>

      <input id="busca" class="search" placeholder="Buscar por nome, CNPJ, e-mail...">

      <table class="table" id="tabelaFornecedores">
        <thead> <th>Ações</th>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fornecedores as $f): ?>
            <tr>
              <td><?= (int)$f['id'] ?></td>
              <td><?= htmlspecialchars($f['nome']) ?></td>
              <td><?= htmlspecialchars($f['cnpj']) ?></td>
              <td><?= htmlspecialchars($f['email'] ?? '') ?></td>
              <td><?= htmlspecialchars($f['telefone'] ?? '') ?></td>
              <td>
                <span class="pill <?= $f['status'] === 'ativo' ? 'ok' : 'off' ?>">
                  <?= htmlspecialchars($f['status']) ?>
                </span>
              </td>
              <td>
             <button class="btn-secondary btnEditar" data-id="<?= (int)$f['id'] ?>">Editar</button>
          </td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <p class="hint">
    </p>
  </div>

  <script src="assets/js/fornecedores.js"></script>
  <div id="modalEditar" style="display:none;" class="card">
  <h2>Editar fornecedor</h2>
  <form id="formEditarFornecedor">
    <input type="hidden" name="id" id="edit_id">

    <div class="grid">
      <label>Nome* <input type="text" name="nome" id="edit_nome" required></label>
      <label>CNPJ* <input type="text" name="cnpj" id="edit_cnpj" required></label>
      <label>E-mail <input type="email" name="email" id="edit_email"></label>
      <label>Telefone <input type="text" name="telefone" id="edit_telefone"></label>
      <label>Status
        <select name="status" id="edit_status">
          <option value="ativo">Ativo</option>
          <option value="inativo">Inativo</option>
        </select>
      </label>
    </div>

    <button type="submit">Salvar alterações</button>
    <button type="button" class="btn-secondary" id="btnFecharModal">Cancelar</button>
  </form>
</div>
</body>
</html>
