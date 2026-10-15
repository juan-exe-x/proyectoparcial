<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=hinord_web;charset=utf8mb4', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function csrf(){ return $_SESSION['t'] ??= bin2hex(random_bytes(16)); }
function csrf_ok(){ return hash_equals($_SESSION['t'] ?? '', (string)($_POST['t'] ?? '')); }
function solo_admin(){ if (($_SESSION['rol'] ?? '') !== 'admin') { header('Location: ../login.php'); exit; } }
function cabecera($t, $b = ''){ ?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($t) ?> - HINORD</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $b ?>css/estilos.css"></head><body>
<nav><a class="logo" href="<?= $b ?>index.php"><svg width="28" height="28" viewBox="0 0 32 32"><rect width="32" height="32" rx="7" fill="#7ec850"/><path d="M9 8v16M23 8v16M9 16h14" stroke="#1a2e1a" stroke-width="3.5" stroke-linecap="round"/></svg>HIN<span>ORD</span></a>
<input type="checkbox" id="m"><label for="m" class="burger">☰</label>
<ul><li><a href="<?= $b ?>index.php">Inicio</a></li><li><a href="<?= $b ?>quienes-somos.php">Quiénes somos</a></li><li><a href="<?= $b ?>contacto.php">Contáctenos</a></li>
<?php if (isset($_SESSION['uid'])): if ($_SESSION['rol'] === 'admin'): ?><li><a href="<?= $b ?>admin/index.php">Panel</a></li><?php endif; ?>
<li><a class="btn" href="<?= $b ?>logout.php">Salir (<?= e($_SESSION['nombre']) ?>)</a></li>
<?php else: ?><li><a class="btn" href="<?= $b ?>login.php">Ingresar</a></li><?php endif; ?></ul></nav>
<?php }
function pie(){ ?>
<footer><b>HINORD</b><span>© <?= date('Y') ?> HINORD · Sistema de Gestión Ganadera</span></footer></body></html>
<?php }
