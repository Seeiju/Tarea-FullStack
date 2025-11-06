
<?php
require "db.php";

function getUserId() {
    $auth = apache_request_headers()["Authorization"] ?? "";
    return intval(base64_decode(str_replace("Bearer ", "", $auth)));
}

$userId = getUserId();



if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $stmt = $pdo->prepare("SELECT id, nombre, apellido, correo FROM usuarios WHERE id=?");
    $stmt->execute([$userId]);

    echo json_encode($stmt->fetch());
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input["correo"])) {
        http_response_code(400);
        echo json_encode(["error" => "El correo no puede cambiarse"]);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE usuarios SET nombre=?, apellido=? WHERE id=?");
    $stmt->execute([
        $input["nombre"],
        $input["apellido"],
        $userId
    ]);

    echo json_encode(["ok" => true]);
    exit;
}
