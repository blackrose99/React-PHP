<?php
require '../config/db.php';
require '../controllers/EmpleadoController.php';

// Establece los encabezados CORS y el tipo de contenido JSON
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// Instancia el controlador de empleado
$controller = new EmpleadoController();

// Obtiene el método de solicitud HTTP
$request_method = $_SERVER["REQUEST_METHOD"];

// Enrutamiento de solicitudes
switch($request_method) {
    // Manejo de solicitudes GET
    case 'GET':
        // Si se proporciona un ID en la URL, obtiene un empleado específico
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $controller->getEmpleado($id); // Llama al método getEmpleado del controlador
        } else {
            $controller->getEmpleados(); // Llama al método getEmpleados del controlador
        }
        break;
    // Manejo de solicitudes POST
    case 'POST':
        $controller->createEmpleado(); // Llama al método createEmpleado del controlador
        break;
    // Manejo de solicitudes PUT
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = intval($_GET["id"]);
        $controller->updateEmpleado($id, $_PUT); // Llama al método updateEmpleado del controlador
        break;
    // Manejo de solicitudes DELETE
    case 'DELETE':
        $id = intval($_GET["id"]);
        $controller->deleteEmpleado($id); // Llama al método deleteEmpleado del controlador
        break;
    // Manejo de métodos no permitidos
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
