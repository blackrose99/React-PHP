<?php
require_once('../config/db.php');

class Empleado {
    private $pdo;

    // Atributos
    private $id;
    private $tipoDocumento; // Nuevo campo
    private $nombre;
    private $apellido;
    private $email;
    private $telefono;

    public function __construct() {
        $this->pdo = $GLOBALS['pdo'];
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    // Método para insertar un nuevo empleado
    public function insertarEmpleado() {
        try {
            $query = "INSERT INTO empleados (tipoDocumento, nombre, apellido, email, telefono) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([$this->tipoDocumento, $this->nombre, $this->apellido, $this->email, $this->telefono]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para obtener todos los empleados
    public function getAllEmpleados() {
        try {
            $query = "SELECT * FROM empleados";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para obtener un empleado por su ID
    public function getEmpleadoById($id) {
        try {
            $query = "SELECT * FROM empleados WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para actualizar un empleado
    public function actualizarEmpleado() {
        try {
            $query = "UPDATE empleados SET tipoDocumento = ?, nombre = ?, apellido = ?, email = ?, telefono = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([$this->tipoDocumento, $this->nombre, $this->apellido, $this->email, $this->telefono, $this->id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para eliminar un empleado
    public function eliminarEmpleado($id) {
        try {
            $query = "DELETE FROM empleados WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
