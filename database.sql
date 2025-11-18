CREATE DATABASE maka_proyectoweb;
USE maka_proyectoweb;

CREATE TABLE usuarios (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    fecha_registro DATETIME DEFAULT GETDATE()
);

CREATE TABLE ingresos (
    id INT IDENTITY(1,1) PRIMARY KEY,
    usuario_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha_registro VARCHAR(100),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 2. Tabla de categorías de gastos
CREATE TABLE categorias_gasto (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL, -- 'Obligatorio', 'Reducible', 'Variable'
    descripcion VARCHAR(255)    
);

-- 3. Tabla de gastos
CREATE TABLE gastos (
    id INT IDENTITY(1,1) PRIMARY KEY,
    usuario_id INT NOT NULL,
    categoria_id INT NOT NULL,
    descripcion VARCHAR(255),
    monto DECIMAL(10,2) NOT NULL,
    fecha_registro VARCHAR(100),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias_gasto(id)
);

-- 4. Tabla de aportaciones al ahorro
CREATE TABLE aportaciones_ahorro (
    id INT IDENTITY(1,1) PRIMARY KEY,
    usuario_id INT NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha_registro VARCHAR(100),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- 5. Tabla resumen de presupuesto semanal
CREATE TABLE presupuesto (
    id INT IDENTITY(1,1) PRIMARY KEY,
    usuario_id INT NOT NULL,
    total_ingresos DECIMAL(10,2) DEFAULT 0,
    total_gastos DECIMAL(10,2) DEFAULT 0,
    total_ahorro DECIMAL(10,2) DEFAULT 0,
    capacidad_ahorro DECIMAL(10,2) DEFAULT 0,
    fecha_semana DATE NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


CREATE VIEW vista_historial_general AS
SELECT
    u.id AS usuario_id,
    u.nombre + ' ' + u.apellido AS usuario,
    COALESCE(i.fecha_registro, g.fecha_registro, a.fecha_registro, p.fecha_semana) AS periodo,

    CASE 
        WHEN i.id IS NOT NULL THEN 'Ingreso'
        WHEN g.id IS NOT NULL THEN 'Gasto'
        WHEN a.id IS NOT NULL THEN 'Ahorro'
        WHEN p.id IS NOT NULL THEN 'Resumen Semanal'
    END AS tipo,

    c.nombre AS categoria_gasto,
    g.descripcion AS detalle_gasto,

    i.monto AS monto_ingreso,
    g.monto AS monto_gasto,
    a.monto AS monto_ahorro,

    p.total_ingresos,
    p.total_gastos,
    p.total_ahorro,
    p.capacidad_ahorro

FROM usuarios u
LEFT JOIN ingresos i 
    ON u.id = i.usuario_id
LEFT JOIN gastos g 
    ON u.id = g.usuario_id
INNER JOIN categorias_gasto c 
    ON g.categoria_id = c.id
LEFT JOIN aportaciones_ahorro a 
    ON u.id = a.usuario_id
LEFT JOIN presupuesto p 
    ON u.id = p.usuario_id;


SELECT *
FROM vista_historial_general
WHERE usuario_id = @idUsuario
ORDER BY periodo DESC;
