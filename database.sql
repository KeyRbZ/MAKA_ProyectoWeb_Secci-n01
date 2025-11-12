CREATE DATABASE IF NOT EXISTS maka_proyectoweb;
    USE maka_proyectoweb;


    CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

    CREATE TABLE IF NOT EXISTS maka_calculadora (
        id INT PRIMARY KEY IDENTITY,
        fk_id INT,
        nombre VARCHAR(100) NOT NULL,
        mes VARCHAR(50) NOT NULL,
        semana VARCHAR(50) NOT NULL
);

    ALTER TABLE maka_calculadora ADD CONSTRAINT fk_usuarios
    FOREIGN KEY (fk_id) REFERENCES usuarios(id);

    SELECT fk_id AS 'ID', mes AS 'Mes', semana AS 'Semana'
    FROM maka_calculadora;

