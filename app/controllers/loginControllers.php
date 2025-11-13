<?php

// Importamos las dependencias

require __DIR__ . '/../helpers/alert_helpers.php';
require __DIR__ . '/../models/Login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturamos en variables los valores enviados a traves de los names de formulario y el metho POST 

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';


    if (empty($email) || empty($password)) {
        mostrarSweetAlert('error', 'Campos vacio', 'Por favor complete todos los campos');
        exit();
    }

    // POO - instanciamos la clase del modelo, para acceder a un METHOd (funcion) en especifico.

    $login = new Login();
    $resultado =  $login->autenticar($email, $password);

    // Verificar si el modelo devolvio un error

    if (isset($resultado['error'])) {
        mostrarSweetAlert('error', 'error de atunticacion', $resultado['error']);
        exit();
    }

    // Si pasa esta linea, el usuario es valido

    session_start();
    $_SESSION['user'] = [
        'id' => $resultado['id_usuario'],
        'nombres' => $resultado['nombre'],
        'rol' => $resultado['id_rol'],
        'id_veterinaria' => $resultado['id_veterinaria']
    ];

    mostrarSweetAlert('success', 'Bienvenido', 'Inicio de sesion exitoso. Redirigiendo...', '/vetwilling/veterinario/dashboard');
    exit();
} else {
    http_response_code(405);
    echo "Metodo no permitido";
    exit();
}
