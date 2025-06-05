<?php
class AuthModels {
    private $pdo;

    public function __construct() {
        require_once '../config/database.php';
        global $pdo;
        $this->pdo = $pdo;
    }

    public function verificarUsuario($email, $senha) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($usuario && password_verify($senha, $usuario['senha'])) ? $usuario : false;
    }

    public function registrarUsuario($nome, $email, $senha) {
        if ($this->emailExiste($email)) {
            return false;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash]);
    }

    private function emailExiste($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }
}
?>