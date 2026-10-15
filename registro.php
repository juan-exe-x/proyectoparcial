<?php require 'includes/app.php';
$err = []; $n = $c = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_ok()) $err[] = 'Sesión inválida, recarga la página.';
  $n = trim($_POST['nombre'] ?? ''); $c = trim($_POST['correo'] ?? ''); $p = $_POST['password'] ?? '';
  if ($n === '' || $c === '' || $p === '') $err[] = 'Todos los campos son obligatorios.';
  if ($c !== '' && !filter_var($c, FILTER_VALIDATE_EMAIL)) $err[] = 'El correo no tiene un formato válido.';
  if ($p !== '' && strlen($p) < 8) $err[] = 'La contraseña debe tener al menos 8 caracteres.';
  if ($p !== ($_POST['password2'] ?? '')) $err[] = 'Las contraseñas no coinciden.';
  if (!$err) {
    $q = $pdo->prepare('SELECT id FROM usuarios WHERE correo=?'); $q->execute([$c]);
    if ($q->fetch()) $err[] = 'Ese correo ya está registrado.';
    else {
      $rol = $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn() ? 'usuario' : 'admin'; // el primer usuario es administrador
      $pdo->prepare('INSERT INTO usuarios(nombre,correo,password_hash,rol) VALUES(?,?,?,?)')->execute([$n, $c, password_hash($p, PASSWORD_DEFAULT), $rol]);
      $_SESSION['ok'] = 'Cuenta creada. Ya puedes ingresar.'; header('Location: login.php'); exit;
    }
  }
}
cabecera('Registro'); ?>
<section class="sec"><h2>Crear cuenta</h2><form class="form" method="post" novalidate>
<?php foreach ($err as $m) echo '<div class="err">' . e($m) . '</div>'; ?>
<input type="hidden" name="t" value="<?= csrf() ?>">
<label>Nombre</label><input name="nombre" required value="<?= e($n) ?>">
<label>Correo</label><input type="email" name="correo" required value="<?= e($c) ?>">
<label>Contraseña (mín. 8)</label><input type="password" name="password" minlength="8" required>
<label>Repite la contraseña</label><input type="password" name="password2" required>
<button>Registrarme</button><p style="margin-top:14px;font-size:.85rem">¿Ya tienes cuenta? <a href="login.php">Ingresar</a></p></form></section>
<?php pie();
