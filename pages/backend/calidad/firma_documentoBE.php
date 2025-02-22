<?php
//archivo: pages\backend\calidad\firma_documentoBE.php
session_start();
require_once "/home/recciusc/conexiones/config_reccius.php";
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: https://reccius.cl/customware/pages/login.html");
    exit;
}
// Verificación básica para asegurarse de que el usuario está autenticado y los datos necesarios están presentes
if (!isset($_POST['idEspecificacion']) || !isset($_POST['rolUsuario'])) {
    exit('Datos insuficientes');
}
$tipo_tarea='';
$idEspecificacion = intval($_POST['idEspecificacion']);
$rolUsuario = $_POST['rolUsuario'];
$usuario = $_SESSION['usuario'];
$fechaActual = date('Y-m-d'); // Obtiene la fecha actual en formato YYYY-MM-DD

// Preparar la consulta dependiendo del rol del usuario (revisor o aprobador)
if ($rolUsuario == 'revisado_por') {
    $tipo_tarea='Firma 2';
    $query = "UPDATE calidad_especificacion_productos SET fecha_revision = ?, estado='Pendiente de Aprobación' WHERE id_especificacion = ? AND revisado_por = ?";
} elseif ($rolUsuario == 'aprobado_por') {
    $tipo_tarea='Firma 3';
    $query = "UPDATE calidad_especificacion_productos SET fecha_aprobacion = ?, estado='Vigente' WHERE id_especificacion = ? AND aprobado_por = ?";
} else {
    exit('Rol no reconocido');
}

// Ejecutar la consulta
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "sis", $fechaActual, $idEspecificacion, $usuario);
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
            // update 22052024
        //function finalizarTarea($usuarioEjecutor, $id_relacion, $tabla_relacion, $tipoAccion, $esAutomatico = false)
    finalizarTarea($_SESSION['usuario'], $idEspecificacion, 'calidad_especificacion_productos', $tipo_tarea);
    if($tipo_tarea=='Firma 2'){
        $query = "SELECT a.aprobado_por, a.version, b.documento_ingreso FROM `calidad_especificacion_productos` as a left join calidad_productos as b on a.id_producto=b.id WHERE a.id_especificacion = ".$idEspecificacion." limit 1;";
        $result = mysqli_query($link, $query);

        $opciones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            registrarTarea(7, $_SESSION['usuario'], $row['aprobado_por'], 'Aprobar especificación de producto: '.$row['documento_ingreso'].' - versión:'.$row['version'], 1, 'Firma 3', $idEspecificacion, 'calidad_especificacion_productos');
        }
        
    }
    
    echo json_encode(['exito' => true, 'mensaje' => 'Documento firmado con éxito']);
} else {
    echo json_encode(['exito' => false, 'mensaje' => 'Error al firmar el documento']);
}
?>
