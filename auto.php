<?php
require "db.php";

$input = json_decode(file_get_contents("php://input"), true);


if ($_GET["action"] === "register") {

    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo=?");
    $stmt->execute([$input["correo"]]);

    if ($stmt->fetch()) {
        http_response_code(409);
        echo json_encode(["error" => "El correo ya está registrado"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, correo, contrasena_hash)
                           VALUES (?, ?, ?, ?)");

    $stmt->execute([
        $input["nombre"],
        $input["apellido"],
        $input["correo"],
        password_hash($input["contrasena"], PASSWORD_DEFAULT)
    ]);

    echo json_encode(["ok" => true]);
    exit;
}



if ($_GET["action"] === "login") {

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo=?");
    $stmt->execute([$input["correo"]]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($input["contrasena"], $user["contrasena_hash"])) {
        http_response_code(401);
        echo json_encode(["error" => "Credenciales inválidas"]);
        exit;
    }

 
    $token = "Bearer " . base64_encode($user["id"]);

    echo json_encode([
        "token" => $token,
        "user" => [
            "id"       => $user["id"],
            "nombre"   => $user["nombre"],
            "apellido" => $user["apellido"],
            "correo"   => $user["correo"]
        ]
    ]);
}
