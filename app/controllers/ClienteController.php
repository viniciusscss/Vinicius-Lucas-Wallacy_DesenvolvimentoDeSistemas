<?php
require_once __DIR__ . '/../models/ClienteModel.php';

class ClienteController {
    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new ClienteModel();
    }

    // Exibe a lista de clientes (Pode ser acessível por administradores)
    public function index() {
        // REMOVER ESTA LINHA: session_start();
        $clientes = $this->clienteModel->listarTodos();
        require_once __DIR__ . '/../views/cliente/index.php';
    }

    // Exibe o formulário de auto-cadastro para novos clientes
    public function create() {
        // REMOVER ESTA LINHA: session_start();
        // Não é necessário verificar login aqui, pois é para auto-cadastro
        require_once __DIR__ . '/../views/cliente/create.php';
    }

    // Processa o auto-cadastro de um novo cliente
    public function store() {
        // REMOVER ESTA LINHA: session_start();

        // Validação simples
        if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
            $_SESSION['erro'] = "Nome, E-mail e Senha são campos obrigatórios.";
            header('Location: ./?controller=Cliente&action=create');
            exit;
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha']; // A senha será hashada no modelo
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        $cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);

        // Verifica se e-mail ou CPF/CNPJ já existem
        if ($this->clienteModel->emailOuCpfCnpjExiste($email, $cpf_cnpj)) {
            $_SESSION['erro'] = "E-mail ou CPF/CNPJ já cadastrados.";
            header('Location: ./?controller=Cliente&action=create');
            exit;
        }

        if ($this->clienteModel->cadastrar($nome, $email, $senha, $telefone, $cpf_cnpj, $endereco, $data_nascimento)) {
            $_SESSION['msg'] = "Cadastro realizado com sucesso! Você já pode fazer login.";
            header('Location: ./?controller=Auth&action=login'); // Redireciona para o login após cadastro
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar cliente. Tente novamente.";
            header('Location: ./?controller=Cliente&action=create');
            exit;
        }
    }

    // Exibe o formulário para edição de dados do cliente (para o próprio cliente logado ou admin)
    public function edit() {
        // REMOVER ESTA LINHA: session_start();

        // Em um cenário real, aqui você verificaria se o ID do cliente corresponde ao ID do usuário logado
        // ou se o usuário logado tem permissão de administrador.
        // Por enquanto, vamos assumir que o ID vem da URL para demonstração.
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ./?controller=Cliente&action=index'); // Ou redirecionar para perfil
            exit;
        }

        $cliente = $this->clienteModel->buscarPorId($id);

        if (!$cliente) {
            $_SESSION['erro'] = "Cliente não encontrado.";
            header('Location: ./?controller=Cliente&action=index');
            exit;
        }
        require_once __DIR__ . '/../views/cliente/edit.php';
    }

    // Processa a atualização dos dados do cliente
    public function update() {
        // REMOVER ESTA LINHA: session_start();

        if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['email'])) {
            $_SESSION['erro'] = "ID, Nome e E-mail são campos obrigatórios para atualização.";
            header('Location: ./?controller=Cliente&action=edit&id=' . $_POST['id']);
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        $cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);

        if ($this->clienteModel->atualizar($id, $nome, $email, $telefone, $cpf_cnpj, $endereco, $data_nascimento)) {
            $_SESSION['msg'] = "Dados do cliente atualizados com sucesso!";
            header('Location: ./?controller=Cliente&action=index'); // Ou redirecionar para perfil
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao atualizar cliente. Tente novamente.";
            header('Location: ./?controller=Cliente&action=edit&id=' . $id);
            exit;
        }
    }

    // Exclui um cliente (Geralmente apenas para administradores)
    public function delete() {
        // REMOVER ESTA LINHA: session_start();

        // Aqui é crucial implementar o controle de acesso!
        // Apenas "funcionários de cargo de ponta" deveriam poder excluir clientes.
        // Ex: if (!isset($_SESSION['funcionario']) || $_SESSION['funcionario']['cargo'] !== 'administrador') { ... }

        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['erro'] = "ID do cliente não fornecido para exclusão.";
            header('Location: ./?controller=Cliente&action=index');
            exit;
        }

        if ($this->clienteModel->excluir($id)) {
            $_SESSION['msg'] = "Cliente excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir cliente. Tente novamente.";
        }
        header('Location: ./?controller=Cliente&action=index');
        exit;
    }
}