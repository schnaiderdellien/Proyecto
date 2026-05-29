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
require_once __DIR__ . '/../app/Core/autoload.php';


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
    'olvidePassword' => ['controller' => 'UsuarioController', 'action' => 'olvidePassword', 'nivel' => 0],
    'logout'    => ['controller' => 'AuthController',      'action' => 'logout',    'nivel' => 1],
    'dashboard' => ['controller' => 'DashboardController', 'action' => 'index',     'nivel' => 1],

    'clientes'  => ['controller' => 'ClienteController',   'action' => 'clientes',  'nivel' => 1],
    'api_clientes'  => ['controller' => 'ClienteController',   'action' => 'apiClientes',  'nivel' => 1],
    'api_comerciales'  => ['controller' => 'ClienteController',   'action' => 'apiComerciales',  'nivel' => 1],
    'api_metodo_pago'  => ['controller' => 'ClienteController',   'action' => 'apiMetodosPago',  'nivel' => 1],
    'api_impuestos'  => ['controller' => 'ClienteController',   'action' => 'apiImpuestos',  'nivel' => 1],
    'editarCliente' => ['controller' => 'ClienteController', 'action' => 'editarCliente', 'nivel' => 3],
    'guardarCliente' => ['controller' => 'ClienteController', 'action' => 'guardarCliente', 'nivel' => 3],
    'crearPedido' => ['controller' => 'PedidosController', 'action' => 'crearPedido', 'nivel' => 3],

    'productos' => ['controller' => 'ProductosController', 'action' => 'productos', 'nivel' => 1],
    'api_productos'  => ['controller' => 'ProductosController',   'action' => 'apiProductos',  'nivel' => 1],
    'guardarProducto' => ['controller' => 'ProductosController','action' => 'guardarProducto','nivel' => 3],
    'editarProducto' => ['controller' => 'ProductosController','action' => 'editarProducto','nivel' => 3],

    'pedidos' => ['controller' => 'PedidosController', 'action' => 'pedidos', 'nivel' => 1],
    'api_pedidos'  => ['controller' => 'PedidosController',   'action' => 'apiPedidos',  'nivel' => 1],
    'api_estados_pedido'  => ['controller' => 'PedidosController',   'action' => 'apiEstadosPedido',  'nivel' => 1],
    'editarPedido' => ['controller' => 'PedidosController', 'action' => 'editarPedido', 'nivel' => 3],
    'api_pedido_by_id' => ['controller' => 'PedidosController', 'action' => 'apiPedidoById', 'nivel' => 1],
    'guardarPedido' => ['controller' => 'PedidosController', 'action' => 'guardarPedido', 'nivel' => 1],
    'verPedido' => ['controller' => 'PedidosController', 'action' => 'verPedido', 'nivel' => 1],
    'nuevoPedido' => ['controller' => 'PedidosController', 'action' => 'nuevoPedido', 'nivel' => 3],
    'api_nuevo_pedido' => ['controller' => 'PedidosController', 'action' => 'apiNuevoPedido', 'nivel' => 3],


    'usuarios' => ['controller' => 'UsuarioController', 'action' => 'usuarios', 'nivel' => 4],
    'api_usuarios' => ['controller' => 'UsuarioController', 'action' => 'apiUsuarios', 'nivel' => 4],
    'guardarUsuario' => ['controller' => 'UsuarioController', 'action' => 'guardarUsuario', 'nivel' => 4],
    'editarUsuario' => ['controller' => 'UsuarioController', 'action' => 'editarUsuario', 'nivel' => 4],
    'api_roles' => ['controller' => 'UsuarioController', 'action' => 'apiRoles', 'nivel' => 4],
    'resetearPassword' => ['controller' => 'UsuarioController', 'action' => 'resetearPassword', 'nivel' => 4],

    
    'cambiarPassword' => ['controller' => 'UsuarioController','action' => 'cambiarPassword','nivel' => 1],
    'guardarPassword' => ['controller' => 'UsuarioController','action' => 'guardarPassword','nivel' => 1],

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
    header ('Location: index.php?ctl=inicio');
    
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