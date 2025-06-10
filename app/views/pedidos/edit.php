<?php require '../partials/header.php'; ?>
<h2>Editar Pedido</h2>
<form action="update.php" method="POST">
  <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
  <label>Cliente:</label><input type="text" name="cliente" value="<?= $pedido['cliente'] ?>" required><br>
  <label>Produto:</label><input type="text" name="produto" value="<?= $pedido['produto'] ?>" required><br>
  <label>Quantidade:</label><input type="number" name="quantidade" value="<?= $pedido['quantidade'] ?>" required><br>
  <button type="submit">Atualizar</button>
</form>
<?php require '../partials/footer.php'; ?>
