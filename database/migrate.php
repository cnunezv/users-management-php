<?php

declare(strict_types=1);

/**
 * Migración de la base de datos en la nube.
 *
 * Ejecuta database/schema.sql contra la base configurada en las variables de
 * entorno, adaptándolo a un servicio administrado:
 *
 *  - Omite CREATE DATABASE y USE: en la nube la base ya existe y el usuario
 *    no tiene permiso para crear otra.
 *  - Omite los SELECT de verificación del final del script.
 *  - Inserta las carreras de ejemplo solo si la tabla está vacía, para no
 *    revivir en cada despliegue las que ya se eliminaron.
 *
 * Es idempotente: se puede ejecutar en cada arranque del contenedor.
 *
 * Uso:  php database/migrate.php
 */

require_once __DIR__ . '/../Common/DependencyInjection.php';

DependencyInjection::boot();

$schemaFile = __DIR__ . '/schema.sql';
$sql = file_get_contents($schemaFile);

if ($sql === false) {
    fwrite(STDERR, "[migrate] No se pudo leer {$schemaFile}\n");
    exit(1);
}

// Quitar comentarios de línea y separar las sentencias por el ";" final.
$withoutComments = preg_replace('/^\s*--.*$/m', '', $sql);
$statements = array_filter(array_map('trim', preg_split('/;\s*$/m', (string) $withoutComments)));

try {
    $pdo = DependencyInjection::getPdo();
} catch (Throwable $exception) {
    fwrite(STDERR, '[migrate] No se pudo conectar a la base de datos: ' . $exception->getMessage() . "\n");
    exit(1);
}

$executed = 0;

foreach ($statements as $statement) {
    if (preg_match('/^(CREATE\s+DATABASE|USE|SELECT)\b/i', $statement) === 1) {
        continue;
    }

    if (preg_match('/^INSERT\s+INTO\s+carreras_taxi\b/i', $statement) === 1) {
        $total = (int) $pdo->query('SELECT COUNT(*) FROM carreras_taxi')->fetchColumn();

        if ($total > 0) {
            continue;
        }
    }

    try {
        $pdo->exec($statement);
        $executed++;
    } catch (Throwable $exception) {
        fwrite(STDERR, '[migrate] Falló una sentencia: ' . $exception->getMessage() . "\n");
        fwrite(STDERR, '[migrate] ' . substr($statement, 0, 80) . "...\n");
        exit(1);
    }
}

echo "[migrate] Migración aplicada: {$executed} sentencias ejecutadas.\n";
