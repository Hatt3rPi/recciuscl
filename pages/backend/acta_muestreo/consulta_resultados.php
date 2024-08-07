<?php
// archivo pages\backend\acta_muestreo\consulta_resultados.php
session_start();
require_once "/home/recciusc/conexiones/config_reccius.php";

// Comprobar si el ID fue enviado por POST
if (!isset($_POST['id_actaMuestreo'])) {
    echo json_encode(['error' => 'No se proporcionó el ID necesario.']);
    exit;
}

$id_actaMuestreo = intval($_POST['id_actaMuestreo']);

// Consulta para obtener los detalles completos del acta de muestreo y los datos asociados
$query = "SELECT 
            aex.id as id_analisis_externo, aex.id_especificacion, aex.id_producto,
            pr.nombre_producto, pr.formato, pr.concentracion, pr.tipo_producto,
            aex.lote, aex.tamano_lote, aex.codigo_mastersoft, aex.condicion_almacenamiento, aex.tamano_muestra, aex.tamano_contramuestra, aex.tipo_analisis, aex.muestreado_por, aex.revisado_por, aex.url_certificado_acta_de_muestreo,
            usr1.nombre as nombre_usr1, usr1.cargo as cargo_usr1, 
            CASE
                WHEN usr1.qr_documento IS NOT NULL THEN usr1.qr_documento
                WHEN usr1.foto_firma IS NOT NULL THEN usr1.foto_firma
                ELSE 'https://pub-bde9ff3e851b4092bfe7076570692078.r2.dev/firma_no_proporcionada.webp'
            END as foto_firma_usr1,
            usr1.ruta_registroPrestadoresSalud as ruta_registroPrestadoresSalud_usr1, 
            usr2.nombre as nombre_usr2, usr2.cargo as cargo_usr2, 
            CASE
                WHEN usr2.qr_documento IS NOT NULL THEN usr2.qr_documento
                WHEN usr2.foto_firma IS NOT NULL THEN usr2.foto_firma
                ELSE 'https://pub-bde9ff3e851b4092bfe7076570692078.r2.dev/firma_no_proporcionada.webp'
            END as foto_firma_usr2,
            usr2.ruta_registroPrestadoresSalud as ruta_registroPrestadoresSalud_usr2, 
            usr3.nombre as nombre_usr3, usr3.cargo as cargo_usr3, 
            CASE
                WHEN usr3.qr_documento IS NOT NULL THEN usr3.qr_documento
                WHEN usr3.foto_firma IS NOT NULL THEN usr3.foto_firma
                ELSE 'https://pub-bde9ff3e851b4092bfe7076570692078.r2.dev/firma_no_proporcionada.webp'
            END as foto_firma_usr3,
            usr3.ruta_registroPrestadoresSalud as ruta_registroPrestadoresSalud_usr3,
            am.id as id_actaMuestreo, am.numero_registro, am.version_registro, am.numero_acta, am.version_acta, am.fecha_muestreo, am.muestreador, am.responsable, am.verificador, am.fecha_firma_muestreador, am.fecha_firma_responsable, am.fecha_firma_verificador, am.resultados_muestrador, am.resultados_responsable, am.pregunta5, am.pregunta6, am.pregunta7, am.pregunta8,
            (CASE WHEN am.fecha_firma_muestreador IS NOT NULL THEN 1 ELSE 0 END + 
            CASE WHEN am.fecha_firma_responsable IS NOT NULL THEN 1 ELSE 0 END + 
            CASE WHEN am.fecha_firma_verificador IS NOT NULL THEN 1 ELSE 0 END) AS cantidad_firmas,
            aex.solicitado_por as aex_solicitado_por,
            aex.numero_solicitud as aex_numero_solicitud,
            usr2.usuario as usuario_firma2
          FROM calidad_acta_muestreo as am 
          LEFT JOIN `calidad_analisis_externo` as aex ON am.id_analisisExterno=aex.id
          LEFT JOIN calidad_productos as pr ON aex.id_producto = pr.id
          LEFT JOIN usuarios as usr1 ON am.muestreador=usr1.usuario
          LEFT JOIN usuarios as usr2 ON am.responsable=usr2.usuario
          LEFT JOIN usuarios as usr3 ON am.verificador=usr3.usuario
          WHERE am.id = ?";

if ($stmt = mysqli_prepare($link, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $id_actaMuestreo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (empty($data)) {
        echo json_encode(['error' => 'No se encontraron datos para el ID proporcionado.']);
    } else {
        echo json_encode(['analisis_externos' => $data], JSON_UNESCAPED_UNICODE);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Error al preparar la declaración: ' . mysqli_error($link)]);
}

mysqli_close($link);
?>