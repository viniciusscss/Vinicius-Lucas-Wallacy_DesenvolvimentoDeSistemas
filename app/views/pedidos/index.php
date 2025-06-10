<?php require '../partials/header.php'; ?>
<h2>Lista de Pedidos</h2>
<a href="create.php">Novo Pedido</a>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Produto</th>
      <th>Quantidade</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pedidos as $pedido): ?>
      <tr>
        <td><?= $pedido['id'] ?></td>
        <td><?= $pedido['cliente'] ?></td>
        <td><?= $pedido['produto'] ?></td>
        <td><?= $pedido['quantidade'] ?></td>
        <td>
          <a href="edit.php?id=<?= $pedido['id'] ?>">Editar</a>
          <a href="delete.php?id=<?= $pedido['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require '../partials/footer.php'; ?>
