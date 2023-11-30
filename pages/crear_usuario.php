<?php
session_start();

// Verificar si la variable de sesión "usuario" no está establecida o está vacía.
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión.
    header("Location: login.html");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <!-- Asegúrate de incluir el CSS para estilizar tu formulario aquí -->
    <link rel="stylesheet" href="../assets/css/calidad.css">

</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Formulario para Crear Usuario</h2>
            <form id="formCrearUsuario" action="backend/usuario/crear_usuarioBE.php" method="POST">
                <div class="form-group">
                    <label for="nombreUsuario">Nombre:</label>
                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required style="width: 100%;">
                </div>
                <div class="form-group">
                    <label for="correoElectronico">Correo Institucional:</label>
                    <input type="email" class="form-control" id="correoElectronico" name="correoElectronico" required style="width: 100%;">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" readonly style="width: 100%;">
                </div>
                <div class="form-group">
                    <label for="usuario">Empresa:</label>
                    <input type="text" class="form-control" id="empresa" name="empresa"  style="width: 100%;">
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="select-styles" id="rol" name="rol" style="width: 100%;">
                        <!-- Las opciones se cargarán mediante JavaScript -->
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" style="width: 100%;"  ; ">Crear Usuario</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('correoElectronico').addEventListener('input', function () {
            var correo = this.value;
            var usuario = correo.split('@')[0];
            document.getElementById('usuario').value = usuario;
        });
    </script>
</body>

</html>