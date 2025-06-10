<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hortifrúti Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/header_footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/<?= $css ?? 'style.css' ?>">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="<?= BASE_URL ?>">
                    <i class="fas fa-leaf"></i>
                    <span>Hortifrúti Online</span>
                </a>
            </div>
            <nav class="nav-menu">
    <?php
    $currentController = $_GET['controller'] ?? 'Home';
    $currentAction = $_GET['action'] ?? 'index';

    function isActive($controller, $action, $currentController, $currentAction) {
        if ($controller === $currentController && $action === $currentAction) {
            return 'active';
        }
        return '';
    }

    $logado = isset($_SESSION['usuario']) || isset($_SESSION['funcionario']);
    ?>

    <div class="main-links">
        <a href="?controller=Home&action=index" class="<?= isActive('Home', 'index', $currentController, $currentAction) ?>">Home</a>
        <a href="?controller=Home&action=sobre" class="<?= isActive('Home', 'sobre', $currentController, $currentAction) ?>">Sobre</a>
        <a href="?controller=Home&action=contato" class="<?= isActive('Home', 'contato', $currentController, $currentAction) ?>">Contato</a>
    </div>

    <div class="auth-buttons">
        <?php
        // --- CÓDIGO DO CONTADOR DO CARRINHO ---
        $totalItens = 0;
        if (!empty($_SESSION['carrinho'])) {
            $totalItens = array_sum($_SESSION['carrinho']);
        }
        ?>
        <a href="?controller=Carrinho&action=index" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <?php if ($totalItens > 0): ?>
                <span class="cart-counter"><?= $totalItens ?></span>
            <?php endif; ?>
        </a>

        <?php if ($logado): ?>
            <a href="?controller=Auth&action=logout" class="btn-logout">Sair</a>
        <?php else: ?>
            <a href="?controller=Auth&action=login" class="btn-login <?= isActive('Auth', 'login', $currentController, $currentAction) ?>">Login</a>
            <a href="?controller=Cliente&action=create" class="btn-register">Cadastre-se</a>
        <?php endif; ?>
    </div>
</nav>
        </div>
    </header>
    <main class="main-content">