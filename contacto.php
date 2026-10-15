<?php require 'includes/app.php';
$err = []; $v = ['nombre' => '', 'correo' => '', 'asunto' => '', 'mensaje' => ''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_ok()) $err[] = 'Sesión inválida, recarga la página.';
  foreach ($v as $k => $_) $v[$k] = trim($_POST[$k] ?? '');
  foreach ($v as $k => $x) if ($x === '') $err[] = "El campo $k es obligatorio.";
  if ($v['correo'] !== '' && !filter_var($v['correo'], FILTER_VALIDATE_EMAIL)) $err[] = 'El correo no tiene un formato válido.';
  if (mb_strlen($v['nombre']) > 80 || mb_strlen($v['correo']) > 120 || mb_strlen($v['asunto']) > 120 || mb_strlen($v['mensaje']) > 2000) $err[] = 'Un campo supera la longitud permitida.';
  if (!$err) {
    $pdo->prepare('INSERT INTO mensajes_contacto(nombre,correo,asunto,mensaje) VALUES(?,?,?,?)')->execute(array_values($v));
    $_SESSION['ok'] = '¡Mensaje enviado! Te responderemos pronto.'; header('Location: contacto.php'); exit;
  }
}
cabecera('Contáctenos'); ?>
<section class="sec"><span class="tag">Escríbenos</span><h2>Contáctenos</h2>
<form class="form" method="post" novalidate>
<?php if (isset($_SESSION['ok'])) { echo '<div class="ok">' . e($_SESSION['ok']) . '</div>'; unset($_SESSION['ok']); } ?>
<?php foreach ($err as $m) echo '<div class="err">' . e($m) . '</div>'; ?>
<input type="hidden" name="t" value="<?= csrf() ?>">
<label>Nombre</label><input name="nombre" maxlength="80" required value="<?= e($v['nombre']) ?>">
<label>Correo</label><input type="email" name="correo" maxlength="120" required value="<?= e($v['correo']) ?>">
<label>Asunto</label><input name="asunto" maxlength="120" required value="<?= e($v['asunto']) ?>">
<label>Mensaje</label><textarea name="mensaje" rows="5" maxlength="2000" required><?= e($v['mensaje']) ?></textarea>
<button>Enviar mensaje</button></form></section>
<?php pie();
