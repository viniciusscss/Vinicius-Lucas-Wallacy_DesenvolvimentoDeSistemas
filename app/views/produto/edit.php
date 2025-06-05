<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Editar Produto</h2>
    <form method="POST" action="?controller=Produto&action=update">
        <input type="hidden" name="id" value="<?= $produto['id'] ?>">
        
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="<?= $produto['preco'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Estoque</label>
            <input type="number" name="estoque" class="form-control" value="<?= $produto['estoque'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-control" required>
                <option value="1" <?= $produto['categoria_id'] == 1 ? 'selected' : '' ?>>Frutas</option>
                <option value="2" <?= $produto['categoria_id'] == 2 ? 'selected' : '' ?>>Legumes</option>
                <option value="3" <?= $produto['categoria_id'] == 3 ? 'selected' : '' ?>>Verduras</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
