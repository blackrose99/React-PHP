<?php

require_once 'AuthController.php';

class AuthService {
    private $authController;

    public function __construct() {
        $this->authController = new AuthController();
    }

    // Método para iniciar sesión
    public function iniciarSesion($username, $password) {
        return $this->authController->iniciarSesion($username, $password);
    }

    // Método para cerrar sesión (no es necesario en este ejemplo)
    public function cerrarSesion() {
        $this->authController->cerrarSesion();
    }
}

?>
