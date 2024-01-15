<?php
session_start();
require_once "/home/customw2/conexiones/config_reccius.php";

// Verificación básica para asegurarse de que el usuario está autenticado y los datos necesarios están presentes
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']) || !isset($_POST['idEspecificacion']) || !isset($_POST['rolUsuario'])) {
    exit('Acceso denegado o datos insuficientes');
}

$idEspecificacion = intval($_POST['idEspecificacion']);
$rolUsuario = $_POST['rolUsuario'];
$usuario = $_SESSION['usuario'];

// Preparar la consulta dependiendo del rol del usuario (revisor o aprobador)
if ($rolUsuario == 'revisado_por') {
    $query = "UPDATE calidad_especificacion_productos SET fecha_revision = CURRENT_DATE, estado='Pendiente de Aprobación' WHERE id_especificacion = ? AND revisado_por = ?";
} elseif ($rolUsuario == 'aprobado_por') {
    $query = "UPDATE calidad_especificacion_productos SET fecha_aprobacion = CURRENT_DATE, estado='Vigente' WHERE id_especificacion = ? AND aprobado_por = ?";
} else {
    exit('Rol no reconocido');
}

// Ejecutar la consulta
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "is", $idEspecificacion, $usuario);
$exito = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
registrarTrazabilidad(
    $_SESSION['usuario'],
    $_SERVER['PHP_SELF'],
    'Firmar especificación de producto',
    $rolUsuario, // Aquí se debe colocar la información más relevante sobre el error
    $idEspecificacion, // ID del registro, 0 si no se creó
    $query, // Consulta que falló
    [$idEspecificacion, $usuario], // Parámetros de la consulta
    $exito, // Indica que hubo un fracaso
    $exito ? null : mysqli_error($link) // Mensaje de error
);
// Verificar si la actualización fue exitosa
if ($exito) {
    finalizarTarea($_SESSION['usuario'], $idEspecificacion, $rolUsuario);
    echo json_encode(['exito' => true, 'mensaje' => 'Documento firmado con éxito']);
} else {
    echo json_encode(['exito' => false, 'mensaje' => 'Error al firmar el documento']);
}
?>
