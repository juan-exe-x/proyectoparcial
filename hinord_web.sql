CREATE DATABASE IF NOT EXISTS hinord_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hinord_web;
CREATE TABLE IF NOT EXISTS usuarios(id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(80) NOT NULL, correo VARCHAR(120) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL, rol ENUM('admin','usuario') NOT NULL DEFAULT 'usuario', creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS mensajes_contacto(id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(80) NOT NULL, correo VARCHAR(120) NOT NULL, asunto VARCHAR(120) NOT NULL, mensaje TEXT NOT NULL, fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP, estado ENUM('pendiente','atendido') NOT NULL DEFAULT 'pendiente');
CREATE TABLE IF NOT EXISTS integrantes(id INT AUTO_INCREMENT PRIMARY KEY, nombre VARCHAR(100) NOT NULL, rol VARCHAR(100) NOT NULL);
CREATE TABLE IF NOT EXISTS funcionalidades(id INT AUTO_INCREMENT PRIMARY KEY, titulo VARCHAR(80) NOT NULL, descripcion VARCHAR(255) NOT NULL);
INSERT INTO integrantes(nombre,rol) VALUES('Juan Hincapié','Programador principal y líder'),('Camilo Andrés Ordóñez Manrique','Desarrollador y coautor de HINORD'),('Nicol Muñoz','Integrante del equipo'),('Nicole Ortiz','Integrante del equipo');
INSERT INTO funcionalidades(titulo,descripcion) VALUES
('Insumos','Catálogo de 25 productos agropecuarios, compras por lote y descuento automático de stock.'),
('Prevenciones','Registro de vacunas y tratamientos que descuenta dosis y agujas del inventario.'),
('Gestación','Calcula automáticamente la fecha probable de parto según el tipo de fertilización.'),
('Parto y Cría','Registra el parto y da de alta automáticamente a las crías en el hato.'),
('Venta de animal','Ventas en pie o en carne; el animal pasa a estado Vendido.'),
('Leche','Producción diaria por turno y registro de ventas de leche.'),
('Estadísticas','Resumen del estado del hato y de la producción para decidir mejor.');
