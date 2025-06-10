<?php
class ProdutoModels {
    private $pdo;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection();
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM produtos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $preco, $estoque, $categoria_id, $imagem) {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, preco, estoque, categoria_id, imagem) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nome, $preco, $estoque, $categoria_id, $imagem]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $preco, $estoque, $categoria_id, $imagem) {
        $stmt = $this->pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, estoque = ?, categoria_id = ?, imagem = ? WHERE id = ?");
        return $stmt->execute([$nome, $preco, $estoque, $categoria_id, $imagem, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getProdutosByIds(array $ids) {
        if (empty($ids)) {
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
    
        $query = "SELECT * FROM produtos WHERE id IN ($placeholders)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($ids);
    
        $produtos = [];
        while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produtos[$produto['id']] = $produto;
        }
        
        return $produtos;
    } // <-- AQUI TERMINA O MÉTODO getProdutosByIds

    // --- O NOVO MÉTODO DEVE FICAR AQUI, DO LADO DE FORA ---
    public function getById($id) {
        $query = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

} // <-- AQUI TERMINA A CLASSE PRODUTOMODELS
?>