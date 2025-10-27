<?php
// Procesa el registro de usuario (demo, sin base de datos)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: registro.html');
	exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$errors = [];
if ($username === '' || $email === '' || $password === '') {
	$errors[] = 'Todos los campos son requeridos.';
}

// Demo: solo muestra mensaje, no guarda en base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Procesar Registro</title>
	<style>body{font-family:Segoe UI,Arial,sans-serif;padding:1rem} .error{color:#b00020} .ok{color:green}</style>
</head>
<body>
	<h2>Resultado del registro</h2>
	<?php if (!empty($errors)): ?>
		<?php foreach ($errors as $err): ?>
			<p class="error"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></p>
		<?php endforeach; ?>
		<p><a href="registro.html">Volver al formulario de registro</a></p>
	<?php else: ?>
		<p class="ok">¡Registro exitoso! Ahora puedes <a href="login.html">iniciar sesión</a>.</p>
	<?php endif; ?>
</body>
</html>
