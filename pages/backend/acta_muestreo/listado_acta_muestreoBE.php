<?php
session_start();
require_once "/home/customw2/conexiones/config_reccius.php";


// Consulta para obtener las especificaciones de productos
$query = "  SELECT 
                am.estado, 
                am.numero_acta, 
                am.fecha_muestreo, 
                am.responsable, 
                am.ejecutor, 
                am.verificador, 
                concat(pr.nombre_producto, ' ', pr.concentracion, ' - ', pr.formato) as producto, 
                pr.tipo_producto
            FROM `calidad_acta_muestreo` as am
            LEFT JOIN calidad_productos as pr 
            on am.id_producto=pr.id;";

$result = $link->query($query);

$data = [];

if ($result && $result->num_rows > 0) {
    // Recorrer los resultados y añadirlos al array de datos
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Cerrar la conexión a la base de datos
$link->close();

// Enviar los datos en formato JSON
header('Content-Type: application/json');
echo json_encode(['data' => $data]);
?>