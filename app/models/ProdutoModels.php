<?php
class ProdutoModels {
    private $pdo;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->pdo = getConnection(); // usa função que retorna conexão PDO
    }

    public function listarTodos() {
        $stmt = $this->pdo->query("SELECT * FROM produtos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $preco, $estoque, $categoria_id) {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (nome, preco, estoque, categoria_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $preco, $estoque, $categoria_id]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $preco, $estoque, $categoria_id) {
        $stmt = $this->pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, estoque = ?, categoria_id = ? WHERE id = ?");
        return $stmt->execute([$nome, $preco, $estoque, $categoria_id, $id]);
    }

    public function excluir($id) {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
