-- ============================================================
-- Esquema de base de datos — Ejercicio 19: CarreraTaxi
-- Motor: MySQL 8 / MariaDB 10.4+
--
-- Uso local:
--   mysql -u root -p < database/schema.sql
--
-- En un servicio en la nube que ya entrega la base creada
-- (Aiven, Railway, Clever Cloud...), omite la sección 1 y
-- ejecuta el resto sobre esa base.
-- ============================================================

-- El script está en UTF-8: se fija la codificación de la conexión para
-- que las tildes y la ñ se guarden bien sin importar el cliente usado.
SET NAMES utf8mb4;

-- ------------------------------------------------------------
-- 1. Base de datos
-- ------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS crud_usuarios
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE crud_usuarios;

-- ------------------------------------------------------------
-- 2. Tabla de usuarios (entidad común a todos los ejercicios)
--    El id es un UUID v4 generado por la aplicación.
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id          CHAR(36)     NOT NULL,
    name        VARCHAR(100) NOT NULL,
    email       VARCHAR(150) NOT NULL,
    password    VARCHAR(255) NOT NULL,
    role        VARCHAR(20)  NOT NULL DEFAULT 'MEMBER',
    status      VARCHAR(20)  NOT NULL DEFAULT 'PENDING',
    created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3. Tabla de carreras de taxi (ejercicio 19)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS carreras_taxi (
    id                  CHAR(36)          NOT NULL,
    cliente             VARCHAR(100)      NOT NULL,
    taxi                VARCHAR(6)        NOT NULL COMMENT 'Placa del taxi, formato ABC123',
    kilometros          DECIMAL(8,2)      NOT NULL,
    barrio_inicio       VARCHAR(100)      NOT NULL,
    barrio_llegada      VARCHAR(100)      NOT NULL,
    cantidad_pasajeros  TINYINT UNSIGNED  NOT NULL,
    taxista             VARCHAR(100)      NOT NULL,
    precio              DECIMAL(12,2)     NOT NULL,
    duracion_minutos    INT UNSIGNED      NOT NULL,
    created_at          DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          DATETIME          NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_carreras_taxi_barrio_inicio (barrio_inicio),
    KEY idx_carreras_taxi_taxi (taxi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 4. Migración del usuario administrador base
--    Correo:     admin@crud.com
--    Contraseña: admin12345   (guardada como hash bcrypt)
--    Cámbiala después del primer inicio de sesión.
-- ------------------------------------------------------------
INSERT INTO users (id, name, email, password, role, status)
VALUES (
    '00000000-0000-4000-8000-000000000001',
    'Administrador',
    'admin@crud.com',
    '$2y$10$QXYKdJ1S./8/SQoj3rBbQOFmWmrfqdDReknXnZxE59o2HxaOrwQL.',
    'ADMIN',
    'ACTIVE'
)
ON DUPLICATE KEY UPDATE email = email;

-- ------------------------------------------------------------
-- 5. Datos de ejemplo para carreras de taxi
-- ------------------------------------------------------------
INSERT INTO carreras_taxi
    (id, cliente, taxi, kilometros, barrio_inicio, barrio_llegada, cantidad_pasajeros, taxista, precio, duracion_minutos)
VALUES
    ('10000000-0000-4000-8000-000000000001', 'María Fernanda Pájaro', 'UAK512', 6.40, 'El Recreo', 'Centro Histórico', 2, 'Jorge Luis Marrugo', 14000.00, 25),
    ('10000000-0000-4000-8000-000000000002', 'Andrés Felipe Torres', 'TZN903', 3.20, 'Manga', 'Bocagrande', 1, 'Wilson Herrera Julio', 9000.00, 12),
    ('10000000-0000-4000-8000-000000000003', 'Luisa Cabarcas Díaz', 'UAK512', 11.80, 'Crespo', 'Ternera', 4, 'Jorge Luis Marrugo', 24000.00, 40)
ON DUPLICATE KEY UPDATE id = id;

-- ------------------------------------------------------------
-- 6. Verificación
-- ------------------------------------------------------------
SELECT id, name, email, role, status FROM users;
SELECT * FROM carreras_taxi;
