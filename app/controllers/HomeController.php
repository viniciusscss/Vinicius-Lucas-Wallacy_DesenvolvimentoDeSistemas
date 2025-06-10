<?php
require_once __DIR__ . '/../models/ProdutoModels.php';

class HomeController {
    public function index() {
        $produtoModel = new ProdutoModels();
        $produtos = $produtoModel->listarTodos();
        
        $css = 'home.css';
        require_once __DIR__ . '/../views/home/index.php';
    }
    
    public function sobre() {
        $css = 'sobre.css';
        require_once __DIR__ . '/../views/home/sobre.php';
    }
    
    public function contato() {
        $css = 'contato.css';
        require_once __DIR__ . '/../views/home/contato.php';
    }
}
?>