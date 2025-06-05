<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Cadastrar Produto</h2>
    <form method="POST" action="?controller=Produto&action=store">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Estoque</label>
            <input type="number" name="estoque" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-control" required>
                <option value="1">Frutas</option>
                <option value="2">Legumes</option>
                <option value="3">Verduras</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
