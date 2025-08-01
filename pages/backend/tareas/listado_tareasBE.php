<?php
session_start();
require_once "/home/recciusc/conexiones/config_reccius.php";
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: https://reccius.cl/customware/pages/login.html");
    exit;
}
// Consulta para obtener las tareas
$query = "  SELECT 
                a.id,
                DATE_FORMAT(a.fecha_ingreso, '%Y-%m-%d') as fecha_ingreso,
                DATE_FORMAT(a.fecha_vencimiento, '%Y-%m-%d') as fecha_vencimiento,
                DATE_FORMAT(a.fecha_done, '%Y-%m-%d') as fecha_done,
                b.nombre as usuario_creador,
                c.nombre as usuario_ejecutor,
                c.usuario as usuario_ejecutor_usuario,
                a.descripcion_tarea,
                a.estado,
                CASE prioridad 
                    WHEN '1' THEN 'Alta'
                    WHEN '2' THEN 'Media'
                    WHEN '3' THEN 'Baja'
                    ELSE 'Desconocida'
                END AS prioridad,
                a.id_relacion,
                a.tipo,
                a.tabla_relacion
            FROM tareas as a
            LEFT JOIN usuarios as b ON a.usuario_creador = b.usuario
            LEFT JOIN usuarios as c ON a.usuario_ejecutor = c.usuario
            where a.estado not in ('eliminado_por_solicitud_usuario')
            ORDER BY a.id DESC;";

$result = $link->query($query);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$link->close();

header('Content-Type: application/json');
echo json_encode(['data' => $data]);
?>
