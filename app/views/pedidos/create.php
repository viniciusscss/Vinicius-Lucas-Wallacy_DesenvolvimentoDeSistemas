<?php require '../partials/header.php'; ?>
<h2>Novo Pedido</h2>
<form action="store.php" method="POST">
  <label>Cliente:</label><input type="text" name="cliente" required><br>
  <label>Produto:</label><input type="text" name="produto" required><br>
  <label>Quantidade:</label><input type="number" name="quantidade" required><br>
  <button type="submit">Salvar</button>
</form>
<?php require '../partials/footer.php'; ?>
