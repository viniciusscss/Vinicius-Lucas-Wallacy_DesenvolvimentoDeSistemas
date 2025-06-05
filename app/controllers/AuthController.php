<?php
<<<<<<< HEAD
// Certifique-se de que o AuthModels já está sendo incluído
// require_once '../models/AuthModels.php'; // Já existe
require_once '../models/FuncionarioModel.php'; // Adicionar para verificar funcionários

class AuthController {
    private $authModel;
    private $funcionarioModel; // Novo

    public function __construct() {
        // Garante que a sessão seja iniciada antes de qualquer output
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->authModel = new AuthModels(); // Este é para clientes/usuários
        $this->funcionarioModel = new FuncionarioModel(); // Novo, para funcionários
=======
class AuthController {
    private $model;

    public function __construct() {
        require_once '../models/AuthModels.php';
        $this->model = new AuthModels();
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];

<<<<<<< HEAD
            // Tenta login como cliente primeiro
            $usuario = $this->authModel->verificarUsuario($email, $senha);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario; // Armazena info do cliente
                $_SESSION['tipo_usuario'] = 'cliente'; // Identifica o tipo de usuário

=======
            $usuario = $this->model->verificarUsuario($email, $senha);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
                if (isset($_POST['lembrar'])) {
                    setcookie('lembrar_email', $email, time() + 86400 * 30, '/');
                }

<<<<<<< HEAD
                header('Location: ./?controller=Home');
                exit;
            } else {
                // Se não for cliente, tenta login como funcionário
                $funcionario = $this->funcionarioModel->verificarLogin($email, $senha);

                if ($funcionario) {
                    $_SESSION['funcionario'] = $funcionario; // Armazena info do funcionário, incluindo cargo
                    $_SESSION['tipo_usuario'] = 'funcionario'; // Identifica o tipo de usuário

                    if (isset($_POST['lembrar'])) {
                        setcookie('lembrar_email', $email, time() + 86400 * 30, '/');
                    }

                    header('Location: ./?controller=Home'); // Ou para um painel de funcionário
                    exit;
                } else {
                    $erro = "E-mail ou senha inválidos!";
                }
=======
                header('Location: /?controller=Home');
                exit;
            } else {
                $erro = "E-mail ou senha inválidos!";
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
            }
        }
        require_once '../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];

<<<<<<< HEAD
            // Reutiliza o AuthModels para o registro de clientes
            if ($this->authModel->registrarUsuario($nome, $email, $senha)) {
                $_SESSION['msg'] = "Cadastro realizado com sucesso! Faça login.";
                header('Location: ./?controller=Auth&action=login');
=======
            if ($this->model->registrarUsuario($nome, $email, $senha)) {
                header('Location: /?controller=Auth&action=login');
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
                exit;
            } else {
                $erro = "E-mail já cadastrado!";
            }
        }
        require_once '../views/auth/register.php';
    }

    public function logout() {
<<<<<<< HEAD
        // Garante que a sessão seja iniciada antes de qualquer output
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset(); // Limpa todas as variáveis de sessão
        session_destroy(); // Destrói a sessão
        setcookie('lembrar_email', '', time() - 3600, '/'); // Remove o cookie de lembrar
        header('Location: ./?controller=Home'); // Redireciona para a Home
        exit;
    }
}
=======
        session_destroy();
        setcookie('lembrar_email', '', time() - 3600, '/');
        header('Location: /?controller=Home');
        exit;
    }
}
?>
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
