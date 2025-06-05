<?php
function getConnection() {
    $host = 'localhost';
    $dbname = 'hortifruti_bd';
    $user = 'root';
<<<<<<< HEAD
    $pass = '';
=======
    $pass = 'Vcs042806@';
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>
