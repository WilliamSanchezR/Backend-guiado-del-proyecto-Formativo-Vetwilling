<?php

// Importamos las dependencias

require __DIR__ . '/../helpers/alert_helpers.php';
require __DIR__ . '/../models/Veterinario.php';

// Creamos una variable METHOD para que capture las peticiones al servidor

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        registrarVeterinario();
        break;

    case 'GET':
        mostrarVeterinario();
        break;

    case 'PUT':
        actualizarVeterinario();
        break;

    case 'DELETE':
        eliminarVeterinario();
        break;

    default:
        http_response_code(405);
        echo "Metodo no permitido";
        break;
}

// Funciones del crud

function registrarVeterinario()
{

    // capturamos en variables los datos desde el formulario a travez del metodo POST y los name de los campos

    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $tipo_documento = $_POST['tipo_documento'] ?? '';
    $numero_documento = $_POST['numero_documento'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $id_rol = '2';
    $password_hash = '123';
    $estado = 'activo';
    $tipo_usuario = 'Veterinario';
    $id_veterinaria = '1';

    // Validamos los caampos que son obligatorios

    if (empty($numero_documento) || empty($nombres) || empty($apellidos) || empty($tipo_documento) || empty($telefono) || empty($email)) {
        mostrarSweetAlert('error', 'Campos vacios', 'Por favor completar todos los campos');
        exit();
    }

    // capturamos el id del usuario que inicia secion para guardarlo solo si es necesario

    session_start();
    $id_veterinaria = $_SESSION['user']['id_veterinaria'];

    // POO - instanciamos la clase

    $objVeterinario = new Veterinario();
    $data = [
        'nombres' => $nombres,
        'apellidos' => $apellidos,
        'tipo_documento' => $tipo_documento,
        'numero_documento' => $numero_documento,
        'telefono' => $telefono,
        'email' => $email,
        'id_rol' => $id_rol,
        'password_hash' => $password_hash,
        'estado' => $estado,
        'tipo_usuario' => $tipo_usuario,
        'id_veterinaria' => $id_veterinaria
    ];

    // Enviamos la data al metodo (registrar) de la clase instanciada anteriormente (Veterinario) y esperamos una respuesta booleana del modelo en resultados

    $resultado = $objVeterinario->registrar($data);

    // Si la respuesta del modelo es verdadera confirmamos el registro y redireccionameos, si es falsa notificamos y redireccionamos

    if ($resultado === true) {
        mostrarSweetAlert('success', 'Registro del veterinario exitoso', 'Se ha creado un nuevo veterinario en la veterinaria', '/vetwilling/veterinario/registrar-veterinario');
    } else {
        mostrarSweetAlert('error', 'Error al registrar', 'No se pudo registrar el veterinario. Intenta nuevamente');
    }
    exit();
}

function mostrarVeterinario()
{

    // session_start();
    $id_veterinaria = $_SESSION['user']['id_veterinaria'];

    // echo $id_veterinaria;

    $resultado = new Veterinario();
    $veterinario = $resultado->listar($id_veterinaria);

    return $veterinario;
}

function actualizarVeterinario() {}

function eliminarVeterinario() {}
