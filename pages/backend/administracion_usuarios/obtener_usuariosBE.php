<?php
require_once "/home/recciusc/conexiones/config_reccius.php";
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: https://reccius.cl/customware/pages/login.html");
    exit;
}
// Verificar la conexión con la base de datos
if (!$link) {
    die(json_encode(['error' => 'Error en la conexión a la base de datos.']));
}

// Consulta para obtener todos los usuarios con su rol asociado
$query = "
    SELECT u.id, u.usuario, u.nombre, u.correo, u.cargo, u.rol_id, r.nombre AS rol 
    FROM usuarios u 
    LEFT JOIN roles r ON u.rol_id = r.id
";
$result = mysqli_query($link, $query);

if (!$result) {
    die(json_encode(['error' => 'Error en la consulta de la base de datos.']));
}

// Crear un array para almacenar los usuarios
$usuarios = [];

while ($row = mysqli_fetch_assoc($result)) {
    $usuarios[] = $row;
}

// Devolver los usuarios en formato JSON
header('Content-Type: application/json');
echo json_encode(['data' => $usuarios]);

// Cerrar la conexión
mysqli_close($link);
?>
