<?php
require_once __DIR__ . '/../models/ProdutoModels.php';

class ProdutoController {
    private $produtoModel;

    public function __construct() {
        $this->produtoModel = new ProdutoModels();
    }

    public function index() {
        session_start();
        $produtos = $this->produtoModel->listarTodos();
        require_once __DIR__ . '/../views/produto/index.php';
    }

    public function create() {
        session_start();
        require_once __DIR__ . '/../views/produto/create.php';
    }

    public function store() {
        session_start();

        // Validação simples
        if (empty($_POST['nome']) || $_POST['preco'] <= 0 || $_POST['estoque'] < 0) {
            die("Dados inválidos. Verifique os campos.");
        }

        $this->produtoModel->cadastrar(
            $_POST['nome'],
            $_POST['preco'],
            $_POST['estoque'],
            $_POST['categoria_id']
        );

        $_SESSION['msg'] = "Produto cadastrado com sucesso!";
        header('Location: ./?controller=Produto&action=index');
    }

    public function edit() {
        session_start();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $produto = $this->produtoModel->buscarPorId($id);
            require_once __DIR__ . '/../views/produto/edit.php';
        }
    }

    public function update() {
        session_start();

        if (empty($_POST['nome']) || $_POST['preco'] <= 0 || $_POST['estoque'] < 0) {
            die("Dados inválidos. Verifique os campos.");
        }

        $this->produtoModel->atualizar(
            $_POST['id'],
            $_POST['nome'],
            $_POST['preco'],
            $_POST['estoque'],
            $_POST['categoria_id']
        );

        $_SESSION['msg'] = "Produto atualizado com sucesso!";
        header('Location: ./?controller=Produto&action=index');
    }

    public function delete() {
        session_start();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->produtoModel->excluir($id);
            $_SESSION['msg'] = "Produto excluído com sucesso!";
        }
        header('Location: ./?controller=Produto&action=index');
    }
}
?>
