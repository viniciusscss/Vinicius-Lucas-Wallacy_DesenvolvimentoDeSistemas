<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h1>Gerenciar Funcionários</h1>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <a href="?controller=Funcionario&action=create" class="btn btn-primary mb-3">Novo Funcionário</a>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Cargo</th>
                <th>Telefone</th>
                <th>CPF/CNPJ</th>
                <th>Tipo Contrato</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($funcionarios)): ?>
                <?php foreach ($funcionarios as $funcionario): ?>
                <tr>
                    <td><?= $funcionario['id'] ?></td>
                    <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                    <td><?= htmlspecialchars($funcionario['email']) ?></td>
                    <td><?= htmlspecialchars($funcionario['cargo']) ?></td>
                    <td><?= htmlspecialchars($funcionario['telefone'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($funcionario['cpf_cnpj'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($funcionario['tipo_contrato']) ?></td>
                    <td>
                        <a href="?controller=Funcionario&action=edit&id=<?= $funcionario['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?controller=Funcionario&action=delete&id=<?= $funcionario['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Nenhum funcionário cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>