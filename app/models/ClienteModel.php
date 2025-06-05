<?php
class ClienteModel {
    private $pdo;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection();
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT id, nome, email, telefone, cpf_cnpj, endereco, data_cadastro, data_nascimento FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha, $telefone, $cpf_cnpj, $endereco, $data_nascimento) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, email, senha, telefone, cpf_cnpj, endereco, data_nascimento) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash, $telefone, $cpf_cnpj, $endereco, $data_nascimento]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, telefone, cpf_cnpj, endereco, data_cadastro, data_nascimento FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $email, $telefone, $cpf_cnpj, $endereco, $data_nascimento) {
        // Não atualiza a senha aqui, para isso seria um método separado ou no controller com validação
        $stmt = $this->pdo->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ?, cpf_cnpj = ?, endereco = ?, data_nascimento = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Método para verificar se email/CPF/CNPJ já existe (para evitar duplicidade no cadastro)
    public function emailOuCpfCnpjExiste($email, $cpf_cnpj) {
        $stmt = $this->pdo->prepare("SELECT id FROM clientes WHERE email = ? OR cpf_cnpj = ?");
        $stmt->execute([$email, $cpf_cnpj]);
        return $stmt->fetch() !== false;
    }
}