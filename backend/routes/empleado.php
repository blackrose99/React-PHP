<?php
require '../controllers/EmpleadoController.php';

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Instanciamos el controlador de empleados
$empleadoController = new EmpleadoController();

// Definimos las rutas y sus correspondientes métodos
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Obtener un empleado por su ID
            $id = $_GET['id'];
            $response = $empleadoController->obtenerEmpleadoPorId($id);
        } else {
            // Obtener todos los empleados
            $response = $empleadoController->obtenerTodosLosEmpleados();
        }
        break;
    case 'POST':
        // Insertar un nuevo empleado
        $datosEmpleado = json_decode(file_get_contents('php://input'), true);
        $response = $empleadoController->insertarEmpleado($datosEmpleado);
        break;
    default:
        $response = ['success' => false, 'message' => 'Método no permitido'];
        break;
}

// Devolvemos la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
