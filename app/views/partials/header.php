<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hortifrúti Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/header_footer.css">
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
=======
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
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
<<<<<<< HEAD
                <?php 
                // Obter o controlador e ação atuais da URL
                $currentController = $_GET['controller'] ?? 'Home';
                $currentAction = $_GET['action'] ?? 'index';

                // Helper para adicionar a classe 'active'
                function isActive($controller, $action, $currentController, $currentAction) {
                    if ($controller === $currentController) {
                        if ($action === 'index' && $currentAction === 'index') {
                            return 'active';
                        }
                        // Para outras ações (ex: sobre, contato), compare a ação
                        if ($action === $currentAction) {
                            return 'active';
                        }
                    }
                    return '';
                }

                // Verificar se a sessão foi iniciada (já garantido por index.php)
                // E se há um usuário ou funcionário logado
                $logado = isset($_SESSION['usuario']) || isset($_SESSION['funcionario']);
                $tipo_usuario = $_SESSION['tipo_usuario'] ?? '';
                $cargo_funcionario = $_SESSION['funcionario']['cargo'] ?? '';

                // Definir cargos de ponta para controle de menu
                $cargosDePonta = ['Gerente', 'Desenvolvedor', 'CEO'];
                $ehCargoDePonta = in_array($cargo_funcionario, $cargosDePonta);
                ?>

                <a href="<?= BASE_URL ?>?controller=Home&action=index" class="<?= isActive('Home', 'index', $currentController, $currentAction) ?>">Home</a>
                <a href="<?= BASE_URL ?>?controller=Home&action=sobre" class="<?= isActive('Home', 'sobre', $currentController, $currentAction) ?>">Sobre</a>
                <a href="<?= BASE_URL ?>?controller=Home&action=contato" class="<?= isActive('Home', 'contato', $currentController, $currentAction) ?>">Contato</a>
                
                <?php if ($logado): ?>
                    <?php if ($tipo_usuario == 'cliente'): ?>
                        <a href="<?= BASE_URL ?>?controller=Cliente&action=edit&id=<?= $_SESSION['usuario']['id'] ?>" class="<?= isActive('Cliente', 'edit', $currentController, $currentAction) ?>">Meu Perfil</a>
                        <?php elseif ($tipo_usuario == 'funcionario'): ?>
                        <a href="<?= BASE_URL ?>?controller=Funcionario&action=index" class="<?= isActive('Funcionario', 'index', $currentController, $currentAction) ?>">Painel Administrativo</a>
                        <?php if ($ehCargoDePonta): ?>
                            <a href="<?= BASE_URL ?>?controller=Produto&action=index" class="<?= isActive('Produto', 'index', $currentController, $currentAction) ?>">Gerenciar Produtos</a>
                            <a href="<?= BASE_URL ?>?controller=Funcionario&action=gerenciarClientes" class="<?= isActive('Funcionario', 'gerenciarClientes', $currentController, $currentAction) ?>">Gerenciar Clientes</a>
                            <a href="<?= BASE_URL ?>?controller=Funcionario&action=index" class="<?= isActive('Funcionario', 'index', $currentController, $currentAction) ?>">Gerenciar Funcionários</a>
                        <?php endif; ?>
                        <a href="<?= BASE_URL ?>?controller=Funcionario&action=edit&id=<?= $_SESSION['funcionario']['id'] ?>" class="<?= isActive('Funcionario', 'edit', $currentController, $currentAction) ?>">Meu Perfil</a>
                    <?php endif; ?>
                    
                    <a href="<?= BASE_URL ?>?controller=Auth&action=logout" class="btn-login">Sair</a>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>?controller=Auth&action=login" class="btn-login <?= isActive('Auth', 'login', $currentController, $currentAction) ?>">Login</a>
                    <?php endif; ?>
=======
                <a href="<?= BASE_URL ?>?controller=Home&action=index">Home</a>
                <a href="<?= BASE_URL ?>?controller=Home&action=sobre">Sobre</a>
                <a href="<?= BASE_URL ?>?controller=Home&action=contato">Contato</a>
                <a href="<?= BASE_URL ?>?controller=Auth&action=login" class="btn-login">Login</a>
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
            </nav>
        </div>
    </header>
    <main class="main-content">