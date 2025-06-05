<?php
class FuncionarioModel {
    private $pdo;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection();
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT id, nome, email, telefone, cpf_cnpj, endereco, data_cadastro, data_nascimento, cargo, tipo_contrato FROM funcionarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $cargo, $tipo_contrato) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO funcionarios (nome, email, senha, telefone, cpf_cnpj, endereco, data_nascimento, cargo, tipo_contrato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $cargo, $tipo_contrato]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, telefone, cpf_cnpj, endereco, data_cadastro, data_nascimento, cargo, tipo_contrato FROM funcionarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $email, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $cargo, $tipo_contrato) {
        // Não atualiza a senha aqui, para isso seria um método separado ou no controller com validação
        $stmt = $this->pdo->prepare("UPDATE funcionarios SET nome = ?, email = ?, telefone = ?, cpf_cnpj = ?, endereco = ?, data_nascimento = ?, cargo = ?, tipo_contrato = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $cargo, $tipo_contrato, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Método para verificar se email/CPF/CNPJ já existe (para evitar duplicidade no cadastro)
    public function emailOuCpfCnpjExiste($email, $cpf_cnpj) {
        $stmt = $this->pdo->prepare("SELECT id FROM funcionarios WHERE email = ? OR cpf_cnpj = ?");
        $stmt->execute([$email, $cpf_cnpj]);
        return $stmt->fetch() !== false;
    }

    // Método para verificar o login do funcionário e retornar o cargo (para controle de acesso)
    public function verificarLogin($email, $senha) {
        $stmt = $this->pdo->prepare("SELECT id, nome, email, cargo FROM funcionarios WHERE email = ?");
        $stmt->execute([$email]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario && password_verify($senha, $funcionario['senha'])) {
            return $funcionario; // Retorna os dados do funcionário, incluindo o cargo
        }
        return false;
    }
}