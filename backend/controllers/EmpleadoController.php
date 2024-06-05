<?php
require '../models/Empleado.php';

class EmpleadoController {
    // Método para obtener todos los empleados
    public function getEmpleados() {
        $empleado = new Empleado();
        $empleados = $empleado->getAllEmpleados();
        
        if ($empleados) {
            $response = array_map(function($empleado) {
                return [
                    'id' => $empleado['id'],
                    'tipoDocumento' => $empleado['tipoDocumento'],
                    'nombre' => $empleado['nombre'],
                    'apellido' => $empleado['apellido'],
                    'email' => $empleado['email'],
                    'telefono' => $empleado['telefono']
                ];
            }, $empleados);

            $this->sendResponse(200, 'Empleados encontrados', $response);
        } else {
            $this->sendResponse(404, 'No se encontraron empleados.');
        }
    }

    // Método para obtener un empleado por su ID
    public function getEmpleado($id) {
        $empleado = new Empleado();
        $empleadoData = $empleado->getEmpleadoById($id);
        
        if ($empleadoData) {
            $response = [
                'id' => $empleadoData['id'],
                'tipoDocumento' => $empleadoData['tipoDocumento'],
                'nombre' => $empleadoData['nombre'],
                'apellido' => $empleadoData['apellido'],
                'email' => $empleadoData['email'],
                'telefono' => $empleadoData['telefono']
            ];
            $this->sendResponse(200, 'Empleado encontrado', $response);
        } else {
            $this->sendResponse(404, 'Empleado no encontrado.');
        }
    }

    // Método para crear un nuevo empleado
    public function createEmpleado() {
        $data = json_decode(file_get_contents("php://input"));

        if (!$data || !isset($data->nombre) || !isset($data->apellido) || !isset($data->email) || !isset($data->telefono) || !isset($data->tipoDocumento)) {
            $this->sendResponse(400, 'Datos incompletos');
            return;
        }

        $empleado = new Empleado();
        $empleado->setNombre($data->nombre);
        $empleado->setApellido($data->apellido);
        $empleado->setEmail($data->email);
        $empleado->setTelefono($data->telefono);
        $empleado->setTipoDocumento($data->tipoDocumento);

        if ($empleado->insertarEmpleado()) {
            $this->sendResponse(201, 'Empleado creado');
        } else {
            $this->sendResponse(500, 'Error al crear empleado');
        }
    }

    // Método para actualizar un empleado
    public function updateEmpleado($id) {
        $data = json_decode(file_get_contents("php://input"));

        if (!$data || !isset($data->nombre) || !isset($data->apellido) || !isset($data->email) || !isset($data->telefono) || !isset($data->tipoDocumento)) {
            $this->sendResponse(400, 'Datos incompletos');
            return;
        }

        $empleado = new Empleado();
        $empleado->setId($id);
        $empleado->setNombre($data->nombre);
        $empleado->setApellido($data->apellido);
        $empleado->setEmail($data->email);
        $empleado->setTelefono($data->telefono);
        $empleado->setTipoDocumento($data->tipoDocumento);

        if ($empleado->actualizarEmpleado()) {
            $this->sendResponse(200, 'Empleado actualizado');
        } else {
            $this->sendResponse(500, 'Error al actualizar empleado');
        }
    }

    // Método para eliminar un empleado
    public function deleteEmpleado($id) {
        $empleado = new Empleado();
        if ($empleado->eliminarEmpleado($id)) {
            $this->sendResponse(200, 'Empleado eliminado');
        } else {
            $this->sendResponse(500, 'Error al eliminar empleado');
        }
    }

    // Método para enviar la respuesta al cliente
    private function sendResponse($status, $message, $data = null) {
        http_response_code($status);
        $response = [
            'status' => $status >= 200 && $status < 300 ? 'success' : 'error',
            'message' => $message
        ];
        if ($data !== null) {
            $response['data'] = $data;
        }
        echo json_encode($response);
    }
}

// Manejo de las solicitudes
$controller = new EmpleadoController();
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $controller->getEmpleado($id);
        } else {
            $controller->getEmpleados();
        }
        break;
    case 'POST':
        $controller->createEmpleado();
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = intval($_GET["id"]);
        $controller->updateEmpleado($id);
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $controller->deleteEmpleado($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
