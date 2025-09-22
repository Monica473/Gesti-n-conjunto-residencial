<?php
session_start(); // Asegura que la sesión se inicie en cada petición

require_once __DIR__ . '/../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- Basic Router ---
$action = $_GET['action'] ?? 'login';

// --- Define routes ---
// This array maps an 'action' to a 'Controller' and a 'method'.
$routes = [
    // Auth
    'login' => ['AuthController', 'showLogin'],
    'handle_login' => ['AuthController', 'handleLogin'],
    'register' => ['AuthController', 'showRegister'],
    'handle_register' => ['AuthController', 'handleRegister'],
    'logout' => ['AuthController', 'logout'],

    // Dashboard
    'dashboard' => ['DashboardController', 'index'],

    // Users (Admin)
    'listUsers' => ['UserController', 'listUsers'],
    'addUser' => ['UserController', 'addUser'],
    'editUser' => ['UserController', 'editUser'],
    'deleteUser' => ['UserController', 'deleteUser'],

    // Profile
    'profile' => ['UserController', 'profile'],
    'changePassword' => ['UserController', 'changePassword'],
    'viewPhoto' => ['UserController', 'viewPhoto'],

    // Records
    'myRecords' => ['RecordController', 'myRecords'],
    'registerEntry' => ['RecordController', 'registerEntry'],
    'registerExit' => ['RecordController', 'registerExit'],

    // Reports (Admin/Guard)
    'report' => ['ReportController', 'index'],
    'viewUserReport' => ['ReportController', 'viewUserReport'],
];

// --- Route Dispatcher ---
if (isset($routes[$action])) {
    list($controllerName, $methodName) = $routes[$action];
    $controllerFile = '../src/controllers/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
            $controller = new $controllerName($conn);
            $controller->$methodName();
        } else {
            echo "Error: Method or class does not exist for action '$action'.";
        }
    } else {
        echo "Error: Controller file '$controllerFile' not found.";
    }
} else {
    // If action is not defined, redirect to login
    header('Location: index.php?action=login');
    exit;
}
?>
