<?php
session_start();

// Configurações básicas
define('BASE_URL', 'http://localhost/Hotifruti_Vinicius_Lucas_Wallacy/app/public/');

<<<<<<< HEAD
// Autoload para controllers e models
spl_autoload_register(function ($class) {
    // Tenta carregar como Controller
    $controllerFile = "../controllers/{$class}.php";
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return; // Encontrou e carregou, sai da função
    }

    // Tenta carregar como Model
    $modelFile = "../models/{$class}.php";
    if (file_exists($modelFile)) {
        require_once $modelFile;
        return; // Encontrou e carregou, sai da função
=======
// Autoload simples para controllers
spl_autoload_register(function ($class) {
    $file = "../controllers/{$class}.php";
    if (file_exists($file)) {
        require_once $file;
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
    }
});

// Rotas
$controller = $_GET['controller'] ?? 'Home';
$action = $_GET['action'] ?? 'index';

$controllerClass = "{$controller}Controller";

<<<<<<< HEAD
// Mapeamento de controladores permitidos para segurança
$allowedControllers = [
    'Home',
    'Auth',
    'Produto',
    'Cliente',
    'Funcionario'
];

if (in_array($controller, $allowedControllers) && class_exists($controllerClass)) {
=======
if (class_exists($controllerClass)) {
>>>>>>> 321605f3475b9d5912aa6d786975baf2704d5e00
    $controllerInstance = new $controllerClass();

    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        http_response_code(404);
        require_once '../views/errors/404.php';
    }
} else {
    http_response_code(404);
    require_once '../views/errors/404.php';
}
?>