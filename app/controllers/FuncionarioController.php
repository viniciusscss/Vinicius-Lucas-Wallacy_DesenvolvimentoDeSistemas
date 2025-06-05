<?php
require_once __DIR__ . '/../models/FuncionarioModel.php';
require_once __DIR__ . '/../models/ClienteModel.php'; // Para gerenciar clientes

class FuncionarioController {
    private $funcionarioModel;
    private $clienteModel; // Instância para gerenciar clientes

    // Define a hierarquia dos cargos com base na autoridade (quanto maior o índice, maior a autoridade)
    private $cargosHierarquia = [
        'Estagiário' => 0,
        'Atendente' => 1,
        'Vendedor' => 2,
        'Carregador' => 3,
        'Suporte' => 4,
        'Marketing' => 5,
        'Gerente' => 6,
        'Desenvolvedor' => 7,
        'CEO' => 8 // 'Dono' renomeado para 'CEO'
    ];

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->funcionarioModel = new FuncionarioModel();
        $this->clienteModel = new ClienteModel();
    }

    // Método auxiliar para verificar se o cargo logado tem permissão para a ação
    private function temPermissaoDePonta() {
        if (!isset($_SESSION['funcionario']) || !isset($_SESSION['funcionario']['cargo'])) {
            return false;
        }

        $cargoLogado = $_SESSION['funcionario']['cargo'];
        $nivelLogado = $this->cargosHierarquia[$cargoLogado] ?? -1; // -1 para cargos não definidos

        // Cargos permitidos para fazer mudanças são Gerente (6) ou superior
        return $nivelLogado >= $this->cargosHierarquia['Gerente'];
    }

    // Método de verificação de cargo de ponta (redireciona se não tiver permissão)
    private function verificarCargoDePonta() {
        if (!$this->temPermissaoDePonta()) {
            $_SESSION['erro'] = "Acesso negado. Você não tem permissão para acessar esta área ou realizar esta ação.";
            header('Location: ./?controller=Home'); // Redireciona para a home ou uma página de acesso negado
            exit;
        }
    }

    // Gerenciar Funcionários (CRUD de Funcionários)

    // Lista todos os funcionários (acessível por cargo de ponta)
    public function index() {
        $this->verificarCargoDePonta(); // Garante que apenas cargos de ponta acessem
        $funcionarios = $this->funcionarioModel->listarTodos();
        require_once __DIR__ . '/../views/funcionario/index.php';
    }

    // Exibe o formulário para cadastrar um novo funcionário (acessível por cargo de ponta)
    public function create() {
        $this->verificarCargoDePonta();
        // Passa os cargos para a view para preencher o select
        $cargosDisponiveis = array_keys($this->cargosHierarquia);
        require_once __DIR__ . '/../views/funcionario/create.php';
    }

    // Processa o cadastro de um novo funcionário
    public function store() {
        $this->verificarCargoDePonta();

        if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['cargo']) || empty($_POST['tipo_contrato'])) {
            $_SESSION['erro'] = "Nome, E-mail, Senha, Cargo e Tipo de Contrato são obrigatórios.";
            header('Location: ./?controller=Funcionario&action=create');
            exit;
        }

        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'];
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        $cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);
        $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING);
        $tipo_contrato = filter_input(INPUT_POST, 'tipo_contrato', FILTER_SANITIZE_STRING);

        // Validação se o cargo existe na hierarquia
        if (!array_key_exists($cargo, $this->cargosHierarquia)) {
            $_SESSION['erro'] = "Cargo inválido selecionado.";
            header('Location: ./?controller=Funcionario&action=create');
            exit;
        }

        if ($this->funcionarioModel->emailOuCpfCnpjExiste($email, $cpf_cnpj)) {
            $_SESSION['erro'] = "E-mail ou CPF/CNPJ já cadastrados para um funcionário.";
            header('Location: ./?controller=Funcionario&action=create');
            exit;
        }

        if ($this->funcionarioModel->cadastrar($nome, $email, $senha, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $cargo, $tipo_contrato)) {
            $_SESSION['msg'] = "Funcionário cadastrado com sucesso!";
            header('Location: ./?controller=Funcionario&action=index');
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar funcionário. Tente novamente.";
            header('Location: ./?controller=Funcionario&action=create');
            exit;
        }
    }

    // Exibe o formulário para editar um funcionário existente (acessível por cargo de ponta)
    public function edit() {
        $this->verificarCargoDePonta();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ./?controller=Funcionario&action=index');
            exit;
        }

        $funcionario = $this->funcionarioModel->buscarPorId($id);

        if (!$funcionario) {
            $_SESSION['erro'] = "Funcionário não encontrado.";
            header('Location: ./?controller=Funcionario&action=index');
            exit;
        }
        // Passa os cargos para a view para preencher o select
        $cargosDisponiveis = array_keys($this->cargosHierarquia);
        require_once __DIR__ . '/../views/funcionario/edit.php';
    }

    // Processa a atualização de um funcionário
    public function update() {
        $this->verificarCargoDePonta();

        if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['cargo']) || empty($_POST['tipo_contrato'])) {
            $_SESSION['erro'] = "Todos os campos obrigatórios devem ser preenchidos para a atualização.";
            header('Location: ./?controller=Funcionario&action=edit&id=' . $_POST['id']);
            exit;
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
        $cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_STRING);
        $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
        $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);
        $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING);
        $tipo_contrato = filter_input(INPUT_POST, 'tipo_contrato', FILTER_SANITIZE_STRING);

        // Validação se o cargo existe na hierarquia
        if (!array_key_exists($cargo, $this->cargosHierarquia)) {
            $_SESSION['erro'] = "Cargo inválido selecionado.";
            header('Location: ./?controller=Funcionario&action=edit&id=' . $id);
            exit;
        }

        if ($this->funcionarioModel->atualizar($id, $nome, $email, $telefone, $cpf_cnpj, $endereco, $data_nascimento, $cargo, $tipo_contrato)) {
            $_SESSION['msg'] = "Funcionário atualizado com sucesso!";
            header('Location: ./?controller=Funcionario&action=index');
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao atualizar funcionário. Tente novamente.";
            header('Location: ./?controller=Funcionario&action=edit&id=' . $id);
            exit;
        }
    }

    // Exclui um funcionário (acessível por cargo de ponta)
    public function delete() {
        $this->verificarCargoDePonta();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['erro'] = "ID do funcionário não fornecido para exclusão.";
            header('Location: ./?controller=Funcionario&action=index');
            exit;
        }

        // Prevenção: Evitar que um funcionário exclua a si mesmo acidentalmente
        if (isset($_SESSION['funcionario']) && $_SESSION['funcionario']['id'] == $id) {
            $_SESSION['erro'] = "Você não pode excluir sua própria conta por esta interface.";
            header('Location: ./?controller=Funcionario&action=index');
            exit;
        }

        if ($this->funcionarioModel->excluir($id)) {
            $_SESSION['msg'] = "Funcionário excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir funcionário. Tente novamente.";
        }
        header('Location: ./?controller=Funcionario&action=index');
        exit;
    }


    // Gerenciar Clientes (CRUD de Clientes pelos Funcionários de Cargo de Ponta)

    // Lista todos os clientes (acessível por cargo de ponta)
    public function gerenciarClientes() {
        $this->verificarCargoDePonta();
        $clientes = $this->clienteModel->listarTodos();
        require_once __DIR__ . '/../views/funcionario/gerenciar_clientes.php';
    }

    // Exibe o formulário para editar um cliente por um funcionário
    public function editarClientePorFuncionario() {
        $this->verificarCargoDePonta();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ./?controller=Funcionario&action=gerenciarClientes');
            exit;
        }

        $cliente = $this->clienteModel->buscarPorId($id);

        if (!$cliente) {
            $_SESSION['erro'] = "Cliente não encontrado.";
            header('Location: ./?controller=Funcionario&action=gerenciarClientes');
            exit;
        }
        require_once __DIR__ . '/../views/funcionario/editar_cliente.php';
    }

    // Processa a atualização de um cliente por um funcionário
    public function atualizarClientePorFuncionario() {
        $this->verificarCargoDePonta();

        if (empty($_POST['id']) || empty($_POST['nome']) || empty($_POST['email'])) {
            $_SESSION['erro'] = "ID, Nome e E-mail são campos obrigatórios para atualização.";
            header('Location: ./?controller=Funcionario&action=editarClientePorFuncionario&id=' . $_POST['id']);
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
            $_SESSION['msg'] = "Dados do cliente atualizados por funcionário com sucesso!";
            header('Location: ./?controller=Funcionario&action=gerenciarClientes');
            exit;
        } else {
            $_SESSION['erro'] = "Erro ao atualizar cliente por funcionário. Tente novamente.";
            header('Location: ./?controller=Funcionario&action=editarClientePorFuncionario&id=' . $id);
            exit;
        }
    }

    // Exclui um cliente por um funcionário
    public function excluirClientePorFuncionario() {
        $this->verificarCargoDePonta();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['erro'] = "ID do cliente não fornecido para exclusão.";
            header('Location: ./?controller=Funcionario&action=gerenciarClientes');
            exit;
        }

        if ($this->clienteModel->excluir($id)) {
            $_SESSION['msg'] = "Cliente excluído por funcionário com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir cliente por funcionário. Tente novamente.";
        }
        header('Location: ./?controller=Funcionario&action=gerenciarClientes');
        exit;
    }
}