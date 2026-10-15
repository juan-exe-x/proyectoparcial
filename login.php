<?php require 'includes/app.php';
$err = []; $c = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $c = trim($_POST['correo'] ?? ''); $p = $_POST['password'] ?? '';
  if (!csrf_ok()) $err[] = 'Sesión inválida, recarga la página.';
  elseif ($c === '' || $p === '') $err[] = 'Ingresa tu correo y contraseña.';
  else {
    $q = $pdo->prepare('SELECT * FROM usuarios WHERE correo=?'); $q->execute([$c]); $u = $q->fetch();
    if ($u && password_verify($p, $u['password_hash'])) {
      session_regenerate_id(true);
      $_SESSION['uid'] = $u['id']; $_SESSION['nombre'] = $u['nombre']; $_SESSION['rol'] = $u['rol'];
      header('Location: ' . ($u['rol'] === 'admin' ? 'admin/index.php' : 'index.php')); exit;
    }
    $err[] = 'Correo o contraseña incorrectos.';
  }
}
cabecera('Ingresar'); ?>
<section class="sec"><h2>Ingresar al sistema</h2><form class="form" method="post" novalidate>
<?php if (isset($_SESSION['ok'])) { echo '<div class="ok">' . e($_SESSION['ok']) . '</div>'; unset($_SESSION['ok']); } ?>
<?php foreach ($err as $m) echo '<div class="err">' . e($m) . '</div>'; ?>
<input type="hidden" name="t" value="<?= csrf() ?>">
<label>Correo</label><input type="email" name="correo" required value="<?= e($c) ?>">
<label>Contraseña</label><input type="password" name="password" required>
<button>Ingresar</button><p style="margin-top:14px;font-size:.85rem">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p></form></section>
<?php pie();
