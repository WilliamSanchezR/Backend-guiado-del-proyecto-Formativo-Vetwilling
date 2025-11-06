<?php

// index.php - Router principal

define('BASE_PATH', __DIR__);

// obtener la URL actual (por ejemplo: /nexus_center/login)

$requestURI = $_SERVER['REQUEST_URI'];

// Quitar le prefijo de la carpeta del proyecto

$request = str_replace('/vetwilling', '', $requestURI);

// Quitar parametros tipo ?id=123

$request = strtok($request, '?');

// Quitar la barra final (si existe)

$request = rtrim($request, '/');

// Si la ruta queda vacia, se interpreta como "/"

if ($request === '') $request = '/';

// Entutamiento basico

switch ($request) {

    case '/':
        require BASE_PATH . '/app/views/website/index.html';
        break;

    case '/login':
        require BASE_PATH . '/app/views/auth/login.html';
        break;

    default:
        http_response_code(404);
        require BASE_PATH . '/app/views/auth/error404.html';
        break;
}

?>