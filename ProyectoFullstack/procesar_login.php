<?php
session_start();

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}

// Basic sanitization
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$errors = [];
if ($username === '' || $password === '') {
    $errors[] = 'Usuario y contraseña son requeridos.';
}

// ===== Demo credential check =====
// TODO: Replace this with a database lookup and hashed password check.
$demoUser = 'admin';
$demoPass = 'secret';

if (empty($errors)) {
    if ($username === $demoUser && $password === $demoPass) {
        // Successful login (demo)
        $_SESSION['username'] = $username;
        header('Location: home.html');
        exit;
    } else {
        $errors[] = 'Credenciales inválidas.';
    }
}

// If we reach here there were errors — show them and a link back.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Procesar Login</title>
    <style>body{font-family:Segoe UI,Arial,sans-serif;padding:1rem} .error{color:#b00020}</style>
</head>
<body>
    <h2>Resultado de inicio de sesión</h2>
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $err): ?>
            <p class="error"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <p><a href="login.html">Volver al formulario de inicio de sesión</a></p>
</body>
</html>
