<?php

class ClienteModel {
    private $pdo;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection();
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT id, nome, email, telefone, endereco FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha, $telefone, $endereco) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO clientes (nome, email, senha, telefone, endereco) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$nome, $email, $senhaHash, $telefone, $endereco]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, telefone, endereco FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarLogin($email, $senha) {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente && password_verify($senha, $cliente['senha'])) {
            unset($cliente['senha']);
            return $cliente;
        }
        return false;
    }

    public function atualizar($id, $nome, $email, $telefone, $endereco) {
        $stmt = $this->pdo->prepare(
            "UPDATE clientes SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?"
        );
        return $stmt->execute([$nome, $email, $telefone, $endereco, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>