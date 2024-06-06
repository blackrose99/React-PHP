<?php

class User {
    // Propiedades
    private $username;
    private $password;

    // Constructor
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    // Métodos de acceso (Getters)
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    // Métodos de modificación (Setters)
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

?>
