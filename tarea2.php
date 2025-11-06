<?php
require "BD.php";

function getUserId() {
    $auth = apache_request_headers()["Authorization"] ?? "";
    return intval(base64_decode(str_replace("Bearer ", "", $auth)));
}

$userId = getUserId();


if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $sql = "SELECT * FROM tareas WHERE owner_id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);

    echo json_encode($stmt->fetchAll());
    exit;
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $input = json_decode(file_get_contents("php://input"), true);

    $sql = "INSERT INTO tareas (owner_id, titulo, descripcion, estado, fecha_inicio, fecha_fin, duracion_estimada)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $pdo->prepare($sql)->execute([
        $userId,
        $input["titulo"],
        $input["descripcion"],
        $input["estado"],
        $input["fecha_inicio"],
        $input["fecha_fin"],
        $input["duracion_estimada"]
    ]);

    echo json_encode(["ok" => true]);
    exit;
}



if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $input = json_decode(file_get_contents("php://input"), true);

    $taskId = $_GET["id"] ?? null;

    $sql = "UPDATE tareas SET
            titulo=?,
            descripcion=?,
            estado=?,
            fecha_inicio=?,
            fecha_fin=?,
            duracion_estimada=?
            WHERE id=? AND owner_id=?";

    $pdo->prepare($sql)->execute([
        $input["titulo"],
        $input["descripcion"],
        $input["estado"],
        $input["fecha_inicio"],
        $input["fecha_fin"],
        $input["duracion_estimada"],
        $taskId,
        $userId
    ]);

    echo json_encode(["ok" => true]);
    exit;
}



if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    $taskId = $_GET["id"] ?? null;

    $sql = "DELETE FROM tareas WHERE id=? AND owner_id=?";
    $pdo->prepare($sql)->execute([$taskId, $userId]);

    echo json_encode(["ok" => true]);
    exit;
}
