#!/usr/bin/env bash
# ============================================================
# Prueba de humo del CRUDL de carreras de taxi (ejercicio 19).
#
# Recorre el flujo completo contra una instancia en ejecución:
# login -> listar -> crear -> consultar -> actualizar -> eliminar,
# más dos casos de validación del dominio.
#
# Uso:
#   BASE_URL=http://localhost:8080/public/index.php bash tests/smoke.sh
#
# Requiere la base creada con database/schema.sql (usuario admin base).
# ============================================================
set -u

BASE_URL="${BASE_URL:-http://localhost:8080/public/index.php}"
ADMIN_EMAIL="${ADMIN_EMAIL:-admin@crud.com}"
ADMIN_PASSWORD="${ADMIN_PASSWORD:-admin12345}"

COOKIES="$(mktemp)"
trap 'rm -f "$COOKIES"' EXIT

failures=0

check() {
    # check "descripción" "texto esperado" "contenido"
    if printf '%s' "$3" | grep -qF -- "$2"; then
        echo "  OK    $1"
    else
        echo "  FALLA $1  (se esperaba: $2)"
        failures=$((failures + 1))
    fi
}

get() { curl -sS -L -b "$COOKIES" -c "$COOKIES" "$BASE_URL?route=$1"; }
post() { local route="$1"; shift; curl -sS -L -b "$COOKIES" -c "$COOKIES" "$@" "$BASE_URL?route=$route"; }

CLIENTE="Cliente Prueba $(date +%s)"

echo "Prueba de humo contra $BASE_URL"

page="$(get carreras.index)"
check "las rutas de carreras exigen sesión" "Iniciar sesión" "$page"

page="$(post auth.authenticate --data-urlencode "email=$ADMIN_EMAIL" --data-urlencode "password=$ADMIN_PASSWORD")"
check "login del administrador" "Cerrar sesión" "$page"

page="$(get carreras.index)"
check "L: listar carreras" "Lista de carreras de taxi" "$page"

page="$(post carreras.store \
    --data-urlencode "cliente=$CLIENTE" --data-urlencode "taxista=Taxista Prueba" \
    --data-urlencode "taxi=xyz-987" --data-urlencode "barrioInicio=Torices" \
    --data-urlencode "barrioLlegada=Getsemaní" --data-urlencode "kilometros=4,5" \
    --data-urlencode "duracionMinutos=15" --data-urlencode "cantidadPasajeros=3" \
    --data-urlencode "precio=10000")"
check "C: registrar carrera" "Carrera de taxi registrada correctamente." "$page"
check "C: la carrera aparece en el listado" "$CLIENTE" "$page"
check "C: la placa se normaliza a XYZ987" "XYZ987" "$page"

# El id (UUID) se toma del formulario de eliminación de la fila recién creada.
id="$(printf '%s' "$page" | grep -F -A 3 "data-name=\"$CLIENTE\"" | grep -oE '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}' | head -n 1)"
check "se obtuvo el id de la carrera creada" "-" "$id"

page="$(get "carreras.show&id=$id")"
check "R: consultar carrera" "$CLIENTE" "$page"
check "R: velocidad promedio calculada por el dominio (18,0 km/h)" "18,0 km/h" "$page"

page="$(post carreras.update \
    --data-urlencode "id=$id" \
    --data-urlencode "cliente=$CLIENTE" --data-urlencode "taxista=Taxista Prueba" \
    --data-urlencode "taxi=XYZ987" --data-urlencode "barrioInicio=Torices" \
    --data-urlencode "barrioLlegada=Manga" --data-urlencode "kilometros=6" \
    --data-urlencode "duracionMinutos=20" --data-urlencode "cantidadPasajeros=4" \
    --data-urlencode "precio=12500")"
check "U: actualizar carrera" "Carrera de taxi actualizada correctamente." "$page"

page="$(get "carreras.show&id=$id")"
check "U: los cambios quedaron guardados" "12.500" "$page"

page="$(post carreras.update \
    --data-urlencode "id=$id" \
    --data-urlencode "cliente=$CLIENTE" --data-urlencode "taxista=Taxista Prueba" \
    --data-urlencode "taxi=XYZ987" --data-urlencode "barrioInicio=Torices" \
    --data-urlencode "barrioLlegada=Manga" --data-urlencode "kilometros=6" \
    --data-urlencode "duracionMinutos=20" --data-urlencode "cantidadPasajeros=9" \
    --data-urlencode "precio=12500")"
check "regla de dominio: máximo 4 pasajeros" "La cantidad de pasajeros debe estar entre 1 y 4" "$page"

page="$(post carreras.store \
    --data-urlencode "cliente=$CLIENTE" --data-urlencode "taxista=Taxista Prueba" \
    --data-urlencode "taxi=12" --data-urlencode "barrioInicio=Torices" \
    --data-urlencode "barrioLlegada=Manga" --data-urlencode "kilometros=6" \
    --data-urlencode "duracionMinutos=20" --data-urlencode "cantidadPasajeros=2" \
    --data-urlencode "precio=12500")"
check "regla de dominio: formato de placa" "La placa del taxi no es válida" "$page"

page="$(post carreras.delete --data-urlencode "id=$id")"
check "D: eliminar carrera" "Carrera de taxi eliminada correctamente." "$page"

page="$(get "carreras.show&id=$id")"
check "D: la carrera ya no existe" "No se encontró la carrera de taxi" "$page"

echo
if [ "$failures" -gt 0 ]; then
    echo "Resultado: $failures verificación(es) fallaron."
    exit 1
fi

echo "Resultado: todas las verificaciones pasaron."
