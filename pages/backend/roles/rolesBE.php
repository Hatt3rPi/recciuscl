<?php
require_once "/home/recciusc/conexiones/config_reccius.php";

header('Content-Type: application/json');

$roles = getRoles();
echo json_encode($roles);

function getRoles() {
    global $link;
    $stmt = mysqli_prepare($link, "SELECT id, nombre FROM roles");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $roles = [];
    while($row = mysqli_fetch_assoc($result)) {
        $roles[] = $row;
    }
    return $roles;
}
?>
