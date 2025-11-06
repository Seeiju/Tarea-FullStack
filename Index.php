<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

$uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));


switch ($uri[1] ?? "") {

    case "auto":
        require "auto.php";
        break;

    case "tareas2":
        require "tarea2.php";
        break;

    case "compartida":
        require "compartida.php";
        break;

    case "usuario2":
        require "usuarios2.php";
        break;

    default:
        echo json_encode(["error" => "Endpoint no encontrado"]);
}
