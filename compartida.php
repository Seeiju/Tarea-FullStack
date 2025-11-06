<?php
require "BD.php";

function getUserId() {
    $auth = apache_request_headers()["Authorization"] ?? "";
    return intval(base64_decode(str_replace("Bearer ", "", $auth)));
}

$userId = getUserId();

$input = json_decode(file_get_contents("php://input"), true);



if ($_GET["action"] === "add") {

    $tareaId = $input["tareaId"];
    $usuarioId = $input["usuarioId"];


    $owner = $pdo->prepare("SELECT owner_id FROM tareas WHERE id=?");
    $owner->execute([$tareaId]);
    $ownerId = $owner->fetchColumn();

    if ($ownerId != $userId) {
        http_response_code(403);
        echo json_encode(["error" => "Solo el creador puede compartir."]);
        exit;
    }

    $sql = "INSERT INTO tareas_compartidas (tarea_id, usuario_id)
            VALUES (?, ?)";
    $pdo->prepare($sql)->execute([$tareaId, $usuarioId]);

    echo json_encode(["ok" => true]);
    exit;
}



if ($_GET["action"] === "list") {

    $tareaId = $_GET["id"];

    $sql = "SELECT u.id, u.nombre, u.apellido, tc.fecha_compartida
            FROM tareas_compartidas tc
            JOIN usuarios u ON u.id = tc.usuario_id
            WHERE tc.tarea_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tareaId]);

    echo json_encode($stmt->fetchAll());
    exit;
}
