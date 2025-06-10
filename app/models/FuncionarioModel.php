<?php

class FuncionarioModel {
    private $pdo;
    private $hierarquia = [
        'CEO' => 4,
        'Gerente' => 3,
        'Funcionario' => 2,
        'Estagiario' => 1
    ];

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection();
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT id, nome, email, cargo FROM funcionarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha, $cargo) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash, $cargo]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, cargo FROM funcionarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarLogin($email, $senha) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, cargo, senha FROM funcionarios WHERE email = ?");
        $stmt->execute([$email]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario && password_verify($senha, $funcionario['senha'])) {
            unset($funcionario['senha']);
            return $funcionario;
        }
        return false;
    }

    public function atualizar($id, $nome, $email, $cargo) {
        $stmt = $this->pdo->prepare("UPDATE funcionarios SET nome = ?, email = ?, cargo = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $cargo, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function podeGerenciar($cargoSolicitante, $cargoAlvo) {
        if (!isset($this->hierarquia[$cargoSolicitante]) || !isset($this->hierarquia[$cargoAlvo])) {
            return false;
        }
        return $this->hierarquia[$cargoSolicitante] > $this->hierarquia[$cargoAlvo];
    }
}
?>