<?php
// archivo: pages\backend\laboratorio\enviar_solicitud_externa.php
session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
  header("Location: https://reccius.cl/customware/pages/login.html");
  exit;
}
header('Content-Type: application/json');
require_once "../otros/laboratorio.php";
require_once "/home/recciusc/conexiones/config_reccius.php";


$input = json_decode(file_get_contents('php://input'), true);

if (
  !isset($input['id_cc']) ||
  empty($input['correo'])
) {
    echo json_encode(['exito' => false, 'mensaje' => 'Datos insuficientes', 'input' => $input]);
    exit;
}

$idCC = $input['id_cc'];
$correo = $input['correo'];


$laboratorio = new Laboratorio();
$resp = $laboratorio->deleteCorreosCCByCorreo($correo,$idCC);

echo json_encode(['msg' => $resp]);

?>
