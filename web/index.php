<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// -------------------------------------------------------------
// Front Controller del mini-framework
// -------------------------------------------------------------
/*<?php echo password_hash("1234", PASSWORD_DEFAULT); ?>*/

require_once __DIR__ . '/../app/libs/Config.php';
require_once __DIR__ . '/../app/libs/bGeneral.php';
require_once __DIR__ . '/../app/libs/bSeguridad.php';
require_once __DIR__ . '/../app/core/autoload.php';


// -------------------------------------------------------------
// Sesión segura
// -------------------------------------------------------------
$session = new SessionManager(
    loginPage: 'index.php?ctl=inicio',
    timeout: 600
);

// Comprobaciones de seguridad (fingerprint + timeout)
$session->checkSecurity();

// -------------------------------------------------------------
// Mapa de rutas
// -------------------------------------------------------------
$map = [
    'inicio'    => ['controller' => 'InicioController',    'action' => 'inicio',    'nivel' => 0],
    'login'     => ['controller' => 'AuthController',      'action' => 'login',     'nivel' => 0],
    'logout'    => ['controller' => 'AuthController',      'action' => 'logout',    'nivel' => 1],
    'dashboard' => ['controller' => 'DashboardController', 'action' => 'index',     'nivel' => 1],
    'clientes'  => ['controller' => 'ClienteController',   'action' => 'clientes',  'nivel' => 1],
    'api_clientes'  => ['controller' => 'ClienteController',   'action' => 'apiClientes',  'nivel' => 1],
    'productos' => ['controller' => 'ProductosController', 'action' => 'productos', 'nivel' => 1],
    'api_productos'  => ['controller' => 'ProductosController',   'action' => 'apiProductos',  'nivel' => 1],
    'api_comerciales'  => ['controller' => 'ClienteController',   'action' => 'apiComerciales',  'nivel' => 1],
    'api_metodo_pago'  => ['controller' => 'ClienteController',   'action' => 'apiMetodosPago',  'nivel' => 1],
    'api_impuestos'  => ['controller' => 'ClienteController',   'action' => 'apiImpuestos',  'nivel' => 1],
    'editarCliente' => ['controller' => 'ClienteController', 'action' => 'editarCliente', 'nivel' => 1],

];

// -------------------------------------------------------------
// Resolución de ruta
// -------------------------------------------------------------
$ruta = $_GET['ctl'] ?? 'inicio';

if (!isset($map[$ruta])) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Error 404: Ruta '$ruta' no encontrada</h1>";
    exit;
}

$controllerName = $map[$ruta]['controller'];
$actionName     = $map[$ruta]['action'];
$requiredLevel  = $map[$ruta]['nivel'];

// -------------------------------------------------------------
// Comprobación de permisos
// -------------------------------------------------------------
if (!$session->hasLevel($requiredLevel)) {
    header("HTTP/1.0 403 Forbidden");
    echo "<h1>403: No tienes permisos para acceder a esta acción</h1>";
    exit;
}

// -------------------------------------------------------------
// Ejecución del controlador
// -------------------------------------------------------------
$controller = new $controllerName($session);

if (!method_exists($controller, $actionName)) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Error 404: Acción '$actionName' no encontrada en $controllerName</h1>";
    exit;
}

$controller->$actionName();
?>