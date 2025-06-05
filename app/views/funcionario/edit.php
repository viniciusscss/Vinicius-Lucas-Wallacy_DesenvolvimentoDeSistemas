<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h2>Editar Dados do Funcionário</h2>

    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="?controller=Funcionario&action=update">
        <input type="hidden" name="id" value="<?= htmlspecialchars($funcionario['id']) ?>">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($funcionario['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($funcionario['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($funcionario['telefone'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="cpf_cnpj" class="form-label">CPF ou CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" value="<?= htmlspecialchars($funcionario['cpf_cnpj'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço Completo</label>
            <textarea class="form-control" id="endereco" name="endereco" rows="3"><?= htmlspecialchars($funcionario['endereco'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($funcionario['data_nascimento'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <select class="form-control" id="cargo" name="cargo" required>
                <option value="">Selecione um cargo</option>
                <?php foreach ($cargosDisponiveis as $c): ?>
                    <option value="<?= htmlspecialchars($c) ?>" <?= ($funcionario['cargo'] == $c) ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo_contrato" class="form-label">Tipo de Contrato</label>
            <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato" value="<?= htmlspecialchars($funcionario['tipo_contrato']) ?>" required>
        </div>
        
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
    </form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>