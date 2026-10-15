<?php require '../includes/app.php'; solo_admin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_ok()) {
  $pdo->prepare("UPDATE mensajes_contacto SET estado='atendido' WHERE id=?")->execute([(int)($_POST['id'] ?? 0)]);
  header('Location: index.php'); exit;
}
$m = $pdo->query('SELECT * FROM mensajes_contacto ORDER BY estado, fecha DESC')->fetchAll();
$u = $pdo->query('SELECT nombre, correo, rol, creado FROM usuarios ORDER BY id')->fetchAll();
cabecera('Panel administrativo', '../'); ?>
<section class="sec"><span class="tag">Administración</span><h2>Mensajes de contacto</h2><div class="tw"><table>
<tr><th>Fecha</th><th>Nombre</th><th>Correo</th><th>Asunto</th><th>Mensaje</th><th>Estado</th></tr>
<?php foreach ($m as $x): ?><tr><td><?= e($x['fecha']) ?></td><td><?= e($x['nombre']) ?></td><td><?= e($x['correo']) ?></td><td><?= e($x['asunto']) ?></td><td><?= nl2br(e($x['mensaje'])) ?></td>
<td><span class="pill <?= e($x['estado']) ?>"><?= e($x['estado']) ?></span><?php if ($x['estado'] === 'pendiente'): ?>
<form method="post"><input type="hidden" name="t" value="<?= csrf() ?>"><input type="hidden" name="id" value="<?= (int)$x['id'] ?>"><button>Marcar atendido</button></form><?php endif; ?></td></tr>
<?php endforeach; if (!$m) echo '<tr><td colspan="6">Sin mensajes.</td></tr>'; ?></table></div>
<h2 style="margin-top:40px">Usuarios registrados</h2><div class="tw"><table><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Creado</th></tr>
<?php foreach ($u as $x): ?><tr><td><?= e($x['nombre']) ?></td><td><?= e($x['correo']) ?></td><td><?= e($x['rol']) ?></td><td><?= e($x['creado']) ?></td></tr><?php endforeach; ?></table></div></section>
<?php pie();
