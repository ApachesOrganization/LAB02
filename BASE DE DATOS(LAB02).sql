-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS blog;
USE blog;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(45) NOT NULL,
    contrasena VARCHAR(80) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Tabla de categorías
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Insertar categorías de ejemplo
INSERT INTO categorias (nombre) VALUES ('Tecnología');
INSERT INTO categorias (nombre) VALUES ('Cultura');
INSERT INTO categorias (nombre) VALUES ('Historia');

-- Tabla de publicaciones
CREATE TABLE publicaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Insertar publicaciones de ejemplo
INSERT INTO publicaciones (titulo, contenido, categoria_id) 
VALUES ('Mi primera publicación', 'Este es el contenido de mi primera publicación en el blog.', 1);

INSERT INTO publicaciones (titulo, contenido, categoria_id) 
VALUES ('Novedades del mes', 'Aquí te cuento todas las novedades que ocurrieron este mes en nuestro blog.', 2);

INSERT INTO publicaciones (titulo, contenido, categoria_id) 
VALUES ('Historia de los Apaches', 'Aquí te cuento la historia de los Apaches.', 3);

-- Tabla de comentarios
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publicacion_id INT NOT NULL,
    contenido TEXT NOT NULL,
    fecha_comentario DATETIME DEFAULT CURRENT_TIMESTAMP,
    usuario_id INT UNSIGNED NULL,
    nombre_usuario VARCHAR(100) NULL,
    FOREIGN KEY (publicacion_id) REFERENCES publicaciones(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);




