<?php require 'includes/app.php';
$i = $pdo->query('SELECT nombre, rol FROM integrantes ORDER BY id')->fetchAll();
cabecera('Quiénes somos'); ?>
<section class="sec"><span class="tag">Descripción</span><h2>Quiénes somos</h2>
<p style="line-height:1.8;max-width:760px">HINORD es un sistema de gestión integral para fincas ganaderas. Su aplicación de escritorio (Java Swing + MariaDB) registra insumos, prevenciones, gestación, partos y crías, ventas y leche; este portal web presenta el proyecto y recibe mensajes de contacto.</p></section>
<section class="dark sec"><div class="in"><div class="grid">
<div><h2>Misión</h2><p>Facilitar al ganadero colombiano el control de su hato y su inventario mediante software confiable, sencillo y adaptado a la realidad del campo.</p></div>
<div><h2>Visión</h2><p>Ser una herramienta de referencia para la gestión ganadera en la región, impulsando decisiones basadas en datos.</p></div></div>
<h2 style="margin-top:30px">Objetivos del sistema</h2><ul class="obj"><li>Centralizar el registro de animales, insumos y producción.</li><li>Automatizar descuentos de inventario y cálculos reproductivos.</li><li>Generar estadísticas para apoyar la toma de decisiones.</li><li>Garantizar la persistencia y seguridad de la información.</li></ul></div></section>
<section class="sec"><span class="tag">Equipo</span><h2>Integrantes responsables</h2><div class="grid"><?php foreach ($i as $x): ?><div class="card"><h3><?= e($x['nombre']) ?></h3><p><?= e($x['rol']) ?></p></div><?php endforeach; ?></div></section>
<?php pie();
