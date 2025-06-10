<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="container mt-5">
    <h1>Gerenciar Clientes</h1>

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

    <a href="?controller=Cliente&action=create" class="btn btn-primary mb-3">Novo Cliente (Auto-cadastro)</a>
    
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>CPF/CNPJ</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente['id'] ?></td>
                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefone'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($cliente['cpf_cnpj'] ?? 'N/A') ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($cliente['data_cadastro'])) ?></td>
                    <td>
                        <a href="?controller=Cliente&action=edit&id=<?= $cliente['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="?controller=Cliente&action=delete&id=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhum cliente cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>