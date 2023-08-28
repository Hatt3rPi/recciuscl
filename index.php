<?php
session_start();
if (!isset($_SESSION['usuario']) or !isset($_SESSION['csrf_token'])) {
    header("Location: .\login\login.php");
    exit();
}
if ($_SESSION['rol'] === 'administrador') {
    echo 'usuario: Administrador'
} elseif ($_SESSION['rol'] === 'vendedor') {
    echo 'usuario: Vendedor'
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reccius</title>
        <link rel="stylesheet" href="./assets/css/style.css">
    
        <!-- CSS de Bootstrap 4 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
        <!-- Estilos CSS de DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        <!-- JS de DataTables -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
        <!-- JS de DataTables con soporte para Bootstrap 4 -->
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://kit.fontawesome.com/7011384382.js" crossorigin="anonymous"></script>

        <!-- usados para gráficos-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
    </head>
<body>
    <header>
        <div class="logo-title-search-container">
            <div class="logo-title-container">
                <img src="./assets/img/logo_reccius_medicina_especializada.png" alt="Logo" href="https://gestionipn.cl/reccius/index.php" class="logo"/>
                <h1>Ayün Plantkeeper</h1>
            </div>
            <div class="user-info">
                <img src="./assets/img/perfil.png" alt="Foto de perfil" class="profile-pic">
                <div class="dropdown">
                    <button class="dropbtn">Nombre de Usuario (Rol)</button>
                    <div class="dropdown-content">
                        <a href="#">Perfil</a>
                        <a href="#">Configuración</a>
                        <a href="#">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container_fas">
        <aside class="sidebar">
            <ul id="sidebarList">
                <li><a class="" style="pointer-events: none;"> </a></li>
                <li class="item" id="usuarios">
                    <a href="#usuarios" class="btn_lateral"><i class="fa fa-user"></i> Usuarios y Roles</a>
                    <div class="smenu">
                        <a href="">Crear Usuario</a>
                        <a href="">Asignar Roles</a>
                    </div>
                </li>
                <li class="item" id="rec_magistrales">
                    <a href="#rec_magistrales" class="btn_lateral"><i class="fa fa-envelope"></i> Recetas Magistrales</a>
                    <div class="smenu">
                        <a href="">Ingreso</a>
                        <a href="">Salida</a>
                        <a href="">Búsqueda</a>
                        <a href="">Trazabilidad</a>
                        <a href="">Conciliación</a>
                    </div>
                </li>
                <li class="item" id="calidad">
                    <a href="#calidad" class="btn_lateral"><i class="fa fa-envelope"></i> Calidad</a>
                    <div class="smenu">
                        <a href="">Paso 1</a>
                        <a href="">Paso 2</a>
                        <a href="">Paso 3</a>
                        <a href="">Paso 4</a>
                    </div>
                </li>
            </ul>
        </aside>
        <main class="content">
            <!-- El contenido se cargará dinámicamente aquí -->
        </main>
    </div>
    <script src="./assets/js/scripts.js"></script>
</body>
</html>