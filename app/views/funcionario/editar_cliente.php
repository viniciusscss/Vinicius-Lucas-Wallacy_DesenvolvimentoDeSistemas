<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Editar Cliente (por Funcionário)</h2>

    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="?controller=Funcionario&action=atualizarClientePorFuncionario">
        <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="cpf_cnpj" class="form-label">CPF ou CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="<?= htmlspecialchars($cliente['cpf_cnpj'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço Completo</label>
            <textarea class="form-control" id="endereco" name="endereco" rows="3"><?= htmlspecialchars($cliente['endereco'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($cliente['data_nascimento'] ?? '') ?>">
        </div>
        
        <button type="submit" class="btn btn-success">Salvar Alterações do Cliente</button>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>