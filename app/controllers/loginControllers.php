<?php

// Importamos las dependencias

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
        'rol' => $resultado['id_rol']
    ];

    mostrarSweetAlert('success', 'Bienvenido', 'Inicio de sesion exitoso. Redirigiendo...', '/vetwilling/veterinario/dashboard');
    exit();
} else {
    http_response_code(405);
    echo "Metodo no permitido";
    exit();
}

// Función para imprimir SweetAlert dinámico con estilo SENA

function mostrarSweetAlert($tipo, $titulo, $mensaje, $redirect = null)
{
    echo "
    <html>
        <head>
            <meta charset='UTF-8'>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap&#39;);

                body {
                    margin: 0;
                    height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(135deg, #00304D, #007832);
                    font-family: 'Montserrat', sans-serif;
                    color: #fff;
                }

                .swal2-popup {
                    font-family: 'Montserrat', sans-serif !important;
                }

                .swal2-title {
                    color: #00304D !important;
                    font-weight: 600 !important;
                }

                .swal2-styled.swal2-confirm {
                    background-color: #007832 !important;
                    border: none !important;
                }

                .swal2-styled.swal2-confirm:hover {
                    background-color: #005d28 !important;
                }

                .swal2-styled.swal2-cancel {
                    background-color: #00304D !important;
                }
            </style>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: '$tipo',
                    title: '$titulo',
                    text: '$mensaje',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#007832',
                    background: '#fff',
                    color: '#00304D'
                }).then((result) => {
                    " . ($redirect ? "window.location.href = '$redirect';" : "window.history.back();") . "
                });
            </script>
        </body>
    </html>";
};
