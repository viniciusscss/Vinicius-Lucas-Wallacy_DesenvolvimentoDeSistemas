<?php
session_start();

// Configurações básicas
// IMPORTANTE: Verifique se o caminho abaixo corresponde exatamente à pasta do seu projeto no XAMPP.
define('BASE_URL', 'http://localhost/Vinicius-Lucas-Wallacy_DesenvolvimentoDeSistemas-main/app/public/');

// Autoload para controllers e models
spl_autoload_register(function ($class) {
    // Tenta carregar como Controller
    $controllerFile = __DIR__ . "/../controllers/{$class}.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return;
    }

    // Tenta carregar como Model
    $modelFile = __DIR__ . "/../models/{$class}.php";
    if (file_exists($modelFile)) {
        require_once $modelFile;
        return;
    }
});

// Rotas
$controller = $_GET['controller'] ?? 'Home';
$action = $_GET['action'] ?? 'index';

$controllerClass = "{$controller}Controller";

// Mapeamento de controladores permitidos para segurança
$allowedControllers = [
    'Home',
    'Auth',
    'Produto',
    'Cliente',
    'Funcionario',
    'Pedido',
    'Carrinho',
    'Checkout' 
];

if (in_array($controller, $allowedControllers) && class_exists($controllerClass)) {
    $controllerInstance = new $controllerClass();

    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        http_response_code(404);
        require_once __DIR__ . '/../views/errors/404.php';
    }
} else {
    http_response_code(404);
    require_once __DIR__ . '/../views/errors/404.php';
}
?>