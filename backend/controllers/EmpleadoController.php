<?php
require '../models/Empleado.php';

class EmpleadoController {
    private $empleadoModel;

    public function __construct() {
        $this->empleadoModel = new Empleado();
    }

    // Método para insertar un nuevo empleado
    public function insertarEmpleado($datosEmpleado) {
        $this->empleadoModel->setTipoDocumento($datosEmpleado['tipoDocumento']);
        $this->empleadoModel->setNombre($datosEmpleado['nombre']);
        $this->empleadoModel->setApellido($datosEmpleado['apellido']);
        $this->empleadoModel->setEmail($datosEmpleado['email']);
        $this->empleadoModel->setTelefono($datosEmpleado['telefono']);
        
        if ($this->empleadoModel->insertarEmpleado()) {
            return ['success' => true, 'message' => 'Empleado insertado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al insertar empleado'];
        }
    }

    // Método para editar un empleado
    public function editarEmpleado($id, $datosEmpleado) {
        $this->empleadoModel->setId($id);
        $this->empleadoModel->setTipoDocumento($datosEmpleado['tipoDocumento']);
        $this->empleadoModel->setNombre($datosEmpleado['nombre']);
        $this->empleadoModel->setApellido($datosEmpleado['apellido']);
        $this->empleadoModel->setEmail($datosEmpleado['email']);
        $this->empleadoModel->setTelefono($datosEmpleado['telefono']);
        
        if ($this->empleadoModel->actualizarEmpleado()) {
            return ['success' => true, 'message' => 'Empleado actualizado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al actualizar empleado'];
        }
    }

    // Método para eliminar un empleado
    public function eliminarEmpleado($id) {
        if ($this->empleadoModel->eliminarEmpleado($id)) {
            return ['success' => true, 'message' => 'Empleado eliminado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al eliminar empleado'];
        }
    }

    // Método para listar un empleado por su ID
    public function obtenerEmpleadoPorId($id) {
        $empleado = $this->empleadoModel->getEmpleadoById($id);
        if ($empleado) {
            return ['success' => true, 'data' => $empleado];
        } else {
            return ['success' => false, 'message' => 'No se encontró ningún empleado con el ID especificado'];
        }
    }

    // Método para listar todos los empleados
    public function obtenerTodosLosEmpleados() {
        $empleados = $this->empleadoModel->getAllEmpleados();
        if ($empleados) {
            return ['success' => true, 'data' => $empleados];
        } else {
            return ['success' => false, 'message' => 'No se encontraron empleados'];
        }
    }
}
?>
