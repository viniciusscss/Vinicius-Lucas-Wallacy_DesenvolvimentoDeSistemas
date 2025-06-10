<?php
require_once __DIR__ . '/../models/ProdutoModels.php';

class CheckoutController {
    private $produtoModel;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->produtoModel = new ProdutoModels();
    }

    public function index() {
        // Lógica para buscar os produtos do carrinho
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

        // Se o carrinho estiver vazio, redireciona de volta para a página do carrinho
        if (empty($produtosNoCarrinho)) {
            header('Location: ?controller=Carrinho&action=index');
            exit;
        }

        $css = 'checkout.css';
        // Agora a view terá acesso às variáveis $produtosNoCarrinho e $totalCarrinho
        require_once __DIR__ . '/../views/checkout/index.php';
    }
}
?>