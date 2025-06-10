<?php
require_once '../models/FuncionarioModel.php';
require_once '../models/ClienteModel.php'; // CORREÇÃO: Usar ClienteModel

class AuthController {
    private $clienteModel; // CORREÇÃO
    private $funcionarioModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->clienteModel = new ClienteModel(); // CORREÇÃO
        $this->funcionarioModel = new FuncionarioModel();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];

            // CORREÇÃO: Tenta login como cliente usando o ClienteModel
            $usuario = $this->clienteModel->verificarLogin($email, $senha); // Um novo método precisa ser criado no ClienteModel

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo_usuario'] = 'cliente';

                if (isset($_POST['lembrar'])) {
                    setcookie('lembrar_email', $email, time() + 86400 * 30, '/');
                }
                header('Location: ./?controller=Home');
                exit;
            } else {
                $funcionario = $this->funcionarioModel->verificarLogin($email, $senha);

                if ($funcionario) {
                    $_SESSION['funcionario'] = $funcionario;
                    $_SESSION['tipo_usuario'] = 'funcionario';

                    if (isset($_POST['lembrar'])) {
                        setcookie('lembrar_email', $email, time() + 86400 * 30, '/');
                    }
                    header('Location: ./?controller=Home');
                    exit;
                } else {
                    $erro = "E-mail ou senha inválidos!";
                }
            }
        }
        require_once '../views/auth/login.php';
    }

    // CORREÇÃO: Este método deve ser removido, pois o cadastro é feito via ClienteController
    /*
    public function register() { ... }
    */

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        setcookie('lembrar_email', '', time() - 3600, '/');
        header('Location: ./?controller=Home');
        exit;
    }
}
?>