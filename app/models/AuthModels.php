<?php
class AuthModels {
    private $pdo;

    public function __construct() {
        // CORREÇÃO: Chamar a função para obter o objeto PDO
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection();
    }

    public function verificarUsuario($email, $senha) {
        // CORREÇÃO: A tabela correta é 'clientes', não 'usuarios'
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($usuario && password_verify($senha, $usuario['senha'])) ? $usuario : false;
    }

    public function registrarUsuario($nome, $email, $senha) {
        // CORREÇÃO: O auto-cadastro é na tabela 'clientes'
        if ($this->emailExiste($email)) {
            return false;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        // CORREÇÃO: Inserir na tabela 'clientes'
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash]);
    }

    private function emailExiste($email) {
        // CORREÇÃO: Verificar na tabela 'clientes'
        $stmt = $this->pdo->prepare("SELECT id FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }
}
?>