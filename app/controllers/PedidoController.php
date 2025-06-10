<?php
require_once __DIR__ . '/../models/PedidoModels.php';

class PedidoController {
    private $pedidoModel;

    public function __construct() {
        // A conexão com o banco é feita dentro do próprio Model
        $this->pedidoModel = new PedidoModels();
    }

    // Ação para listar todos os pedidos
    public function index() {
        $pedidos = $this->pedidoModel->getAll();
        // Carrega a view que exibe a lista de pedidos
        require_once __DIR__ . '/../views/pedidos/index.php';
    }

    // Outras ações (create, store, edit, update, delete) iriam aqui
    // Exemplo de como seria a função para deletar:
    /*
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->pedidoModel->delete($id);
            // Redireciona para a lista de pedidos após deletar
            header('Location: ?controller=Pedido&action=index');
            exit;
        }
    }
    */
}
?>