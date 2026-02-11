<?php
//archivo: pages\backend\laboratorio\validar_lote.php

session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: https://reccius.cl/customware/pages/login.html");
    exit;
}
require_once "/home/recciusc/conexiones/config_reccius.php";
require_once "../otros/validaciones.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $lote = isset($_GET['lote']) ? trim($_GET['lote']) : '';
    $id_especificacion = isset($_GET['id_especificacion']) ? intval($_GET['id_especificacion']) : 0;

    if (empty($lote) || $id_especificacion === 0) {
        echo json_encode(['valid' => true, 'mensaje' => '']);
        exit;
    }

    $resultado = validarLoteProducto($link, $lote, $id_especificacion);
    echo json_encode($resultado);
} else {
    echo json_encode(['valid' => false, 'mensaje' => 'Método no permitido']);
}
