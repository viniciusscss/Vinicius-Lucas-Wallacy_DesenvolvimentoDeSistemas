<?php
class PedidoModels {
    private $db;

    public function __construct() {
        // CORREÇÃO: Usa a função padrão para obter a conexão PDO
        require_once __DIR__ . '/../config/database.php';
        $this->db = getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM pedidos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Adicione os outros métodos (create, update, delete) aqui
    public function delete($id) {
        $query = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>