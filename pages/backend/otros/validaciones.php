<?php
//archivo: pages\backend\otros\validaciones.php

function validarLoteProducto($link, $lote, $id_especificacion) {
    // 1. Resolver id_producto desde id_especificacion vía calidad_especificacion_productos
    $stmt_esp = mysqli_prepare($link, "SELECT id_producto FROM calidad_especificacion_productos WHERE id_especificacion = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt_esp, 'i', $id_especificacion);
    mysqli_stmt_execute($stmt_esp);
    $result_esp = mysqli_stmt_get_result($stmt_esp);
    $row_esp = mysqli_fetch_assoc($result_esp);
    mysqli_stmt_close($stmt_esp);

    if (!$row_esp) {
        return ['valid' => false, 'mensaje' => 'No se encontró la especificación de producto.'];
    }
    $id_producto_actual = $row_esp['id_producto'];

    // 2. Buscar en calidad_analisis_externo si existe un registro con el mismo lote pero diferente id_producto (excluyendo eliminados)
    $stmt_lote = mysqli_prepare($link,
        "SELECT cae.id, cae.id_producto, cp.nombre_producto
         FROM calidad_analisis_externo AS cae
         JOIN calidad_productos AS cp ON cae.id_producto = cp.id
         WHERE cae.lote = ?
           AND cae.id_producto != ?
           AND cae.estado NOT IN ('Eliminado', 'eliminado_por_solicitud_usuario')
         LIMIT 1"
    );
    mysqli_stmt_bind_param($stmt_lote, 'si', $lote, $id_producto_actual);
    mysqli_stmt_execute($stmt_lote);
    $result_lote = mysqli_stmt_get_result($stmt_lote);
    $row_lote = mysqli_fetch_assoc($result_lote);
    mysqli_stmt_close($stmt_lote);

    // 3. Retornar resultado
    if ($row_lote) {
        return [
            'valid' => false,
            'mensaje' => 'El lote "' . $lote . '" ya está asociado al producto "' . $row_lote['nombre_producto'] . '" (ID: ' . $row_lote['id_producto'] . '). No se puede asociar a un producto diferente.'
        ];
    }

    // 4. Mismo lote + mismo producto es válido (re-análisis)
    return ['valid' => true, 'mensaje' => ''];
}
