{{-- <div class="d-flex align-items-center justify-content-center vh-100" style="margin-top: 200px">
    <div class="text-center">
        <h1 class="display-1 fw-bold">403</h1>
        <p class="fs-3"> <span class="text-danger">Aviso!</span> Permiso denegado</p>
        <p class="lead">
           Tu usuario no tiene permiso para acceder a esta página.
        </p>
    </div>
</div> --}}




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Acceso Denegado</title>
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Estilos personalizados inspirados en Voyager -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #4a4a4a;
        }
        .error-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .error-card {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            border: 1px solid #e9ecef;
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #dc3545; /* Rojo para el código de error */
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #6c757d;
        }
        .error-message span {
            color: #dc3545;
            font-weight: bold;
        }
        .error-description {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #6c757d;
        }
        .btn-home {
            background-color: #3c8dbc; /* Azul de Voyager */
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-home:hover {
            background-color: #367fa9; /* Azul más oscuro al pasar el mouse */
        }
        .btn-home i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <h1 class="error-code">403</h1>
            <p class="error-message">¡Atención! <span>Acceso Denegado</span></p>
            <p class="error-description">
                Lo sentimos, pero tu usuario no tiene permiso para acceder a esta página.
            </p>
            <a href="/" class="btn-home">
                <i class="fas fa-home"></i> Volver al Inicio
            </a>
        </div>
    </div>
</body>
</html>