<?php

require_once __DIR__ . '/../../config/database.php';

class Login
{

    private $conexion;

    public function __construct()
    {
        $db = new conexion();
        $this->conexion = $db->getConexion();
    }

    public function autenticar($email, $password)
    {

        try {
            $consultar = "SELECT * FROM usuario WHERE email = :correo AND estado = 'activo' LIMIT 1";
            $resultado = $this->conexion->prepare($consultar);
            $resultado->bindParam(':correo', $email);
            $resultado->execute();

            $user = $resultado->fetch();

            if (!$user) {
                return ['error' => 'Usuario no encontrado o inactivo'];
            }

            // Verificacion de la contraseña incriptada

            if (!password_verify($password, $user['password_hash'])) {
                return ['error' => 'Contraseña incorrecta'];
            }

            return [
                'id_usuario' => $user['id_usuario'],
                'id_rol' => $user['id_rol'],
                'nombre' => $user['nombres'],
                'correo' => $user['email'],
                'id_veterinaria' => $user['id_veterinaria']
            ];
        } catch (PDOException $e) {
            error_log("Error en el modelo login: " . $e->getMessage());
            return ['error' => 'Error interno del servidor'];
        }
    }
}
