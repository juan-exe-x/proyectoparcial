# HINORD Web (PHP 8 + MariaDB)
1. Copia la carpeta a `htdocs` (XAMPP) y enciende Apache y MariaDB.
2. Importa `database/hinord_web.sql` (phpMyAdmin o DBeaver).
3. Si tu usuario/clave de MariaDB no son root/vacío, cámbialos en `includes/app.php`.
4. Pon tus imágenes en `img/` (`finca.png`); abre `http://localhost/hinord-web/`.
5. El PRIMER usuario que se registre en `registro.php` queda como administrador y ve el panel.
