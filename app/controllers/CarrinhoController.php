<?php
require_once __DIR__ . '/../models/ProdutoModels.php';

class CarrinhoController {
    private $produtoModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->produtoModel = new ProdutoModels();
    }

    // MOSTRA A PÁGINA DO CARRINHO
    public function index() {
        $carrinho = $_SESSION['carrinho'] ?? [];
        $produtosNoCarrinho = [];
        $totalCarrinho = 0;

        if (!empty($carrinho)) {
            $idsDosProdutos = array_keys($carrinho);
            $produtosDoBanco = $this->produtoModel->getProdutosByIds($idsDosProdutos);

            foreach ($carrinho as $id => $quantidade) {
                if (isset($produtosDoBanco[$id])) {
                    $produto = $produtosDoBanco[$id];
                    $produto['quantidade'] = $quantidade;
                    $produto['subtotal'] = $quantidade * $produto['preco'];
                    $produtosNoCarrinho[] = $produto;
                    $totalCarrinho += $produto['subtotal'];
                }
            }
        }

        // Define o CSS específico para esta página
        $css = 'carrinho.css';
        require_once __DIR__ . '/../views/carrinho/index.php';
    }

    // ADICIONA UM ITEM AO CARRINHO
    public function adicionar() {
        $idProduto = $_GET['id'] ?? null;
        if ($idProduto) {
            if (!isset($_SESSION['carrinho'])) {
                $_SESSION['carrinho'] = [];
            }
            if (isset($_SESSION['carrinho'][$idProduto])) {
                $_SESSION['carrinho'][$idProduto]++;
            } else {
                $_SESSION['carrinho'][$idProduto] = 1;
            }
        }
        header('Location: ?controller=Home&action=index');
        exit();
    }

    // ATUALIZA A QUANTIDADE DE UM ITEM
    public function atualizar() {
        $idProduto = $_POST['id'] ?? null;
        $quantidade = (int)($_POST['quantidade'] ?? 0);

        if ($idProduto && $quantidade > 0) {
            $produto = $this->produtoModel->getById($idProduto);
            if ($produto && $quantidade <= $produto['estoque']) {
                $_SESSION['carrinho'][$idProduto] = $quantidade;
            }
        }
        header('Location: ?controller=Carrinho&action=index');
        exit();
    }

    // REMOVE UM ITEM DO CARRINHO
    public function remover() {
        $idProduto = $_GET['id'] ?? null;
        if ($idProduto) {
            unset($_SESSION['carrinho'][$idProduto]);
        }
        header('Location: ?controller=Carrinho&action=index');
        exit();
    }
}
?>