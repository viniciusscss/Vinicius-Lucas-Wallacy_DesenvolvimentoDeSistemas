<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h1>Gerenciar Produtos</h1>
    <a href="?controller=Produto&action=criar" class="btn btn-primary">Novo Produto</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['id'] ?></td>
                <td><?= htmlspecialchars($produto['nome']) ?></td>
                <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                <td><?= $produto['estoque'] ?></td>
                <td>
                    <a href="?controller=Produto&action=editar&id=<?= $produto['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="?controller=Produto&action=excluir&id=<?= $produto['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../../partials/footer.php'; ?>