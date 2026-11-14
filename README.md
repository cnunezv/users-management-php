# CRUD Usuarios: Arquitectura Hexagonal con DDD y CQRS

Aplicación web PHP para la gestión de usuarios: registro, listado, visualización, edición, eliminación, autenticación con sesión y recuperación de contraseña por correo.

## Tecnologías

- PHP 8.3
- MySQL
- Apache mod_rewrite

---

## Funcionalidades

- Crear, listar, ver, editar y eliminar usuarios
- Autenticación con sesión (login / logout)
- Recuperación de contraseña mediante contraseña temporal enviada por correo
- Protección de rutas según estado de autenticación
- Protección contra acceso directo a archivos y listado de directorios
- Envía notificaciones a los usuarios vía Correo Electronico

---

## Conceptos aplicados

### Arquitectura general
- Arquitectura Hexagonal (Ports & Adapters)
- DDD (Domain-Driven Design)
- CQRS
- Capas: Domain / Application / Infrastructure / Entrypoints
- Front Controller · Single Entry Point

### Capa de Dominio
- Rich Domain Model
- Value Objects
- Named Constructors
- Domain Exceptions
- Domain Events
- Enumerations (Enums)
- Ubiquitous Language
- Inmutabilidad
- Fail-fast validation
- Encapsulación de reglas de negocio


### Capa de Aplicación
- Use Cases
- Application Services
- Ports In (interfaces de casos de uso)
- Ports Out (interfaces de persistencia)
- Commands y Queries
- DTOs
- Anti-corruption Layer
- Application Mapper


### Capa de Infraestructura
- Repository Pattern
- Data Mapper
- Persistence DTO
- Persistence Entity
- PDO con Prepared Statements
- Adapter Pattern

### Entrypoints / Presentación
- Enrutamiento por query string (`?route=`)
- PRG (Post-Redirect-Get)
- Flash Messages
- Autenticación basada en sesiones
- Web Mapper
- Web DTOs (WebRequest / UserResponse)
- `View::render` con `extract`
- Security Guard (IIFE)

---

### Patrones de diseño
- Front Controller
- Repository
- Data Mapper
- Factory Method
- DTO
- Strategy
- Template Method
- IIFE
- PRG (Post-Redirect-Get)

### Principios SOLID
- **SRP** — Single Responsibility Principle
- **OCP** — Open/Closed Principle
- **LSP** — Liskov Substitution Principle
- **ISP** — Interface Segregation Principle
- **DIP** — Dependency Inversion Principle

### Principios de Clean Code
- `declare(strict_types=1)` en todos los archivos
- Clases `final`
- Value Objects inmutables
- Named Constructors
- Fail-fast
- Nombres autodocumentados
- Separación estricta de capas
- Sin fugas de abstracción
- Fail-safe defaults (valores por defecto seguros)

### Configuración externalizada (12-Factor App: Factor III)
- Variables de entorno separadas del código fuente
- Credenciales en `.env` (ignorado por git), nunca en se debe publicar en el repo
- `.env.example` como plantilla y documentación de ejemplo para el equipo
- `EnvLoader` con responsabilidad única: leer el entorno
- Las variables reales del servidor tienen prioridad sobre `.env` (environment-over-code)

### Seguridad

- Credenciales fuera del código fuente y del historial de git

---

## Ejercicio 19: CRUDL de CarreraTaxi

Sobre la aplicación base se implementó el CRUDL de la entidad **CarreraTaxi**
siguiendo las mismas capas, patrones y convenciones del CRUD de usuarios.

**Autor:** Carlos Andrés Núñez Vargas — Ingeniería de Software, Universidad de Cartagena
(Desarrollo de Software Web, Unidad 2).

### Atributos y reglas de negocio

| Atributo | Value object | Regla |
|---|---|---|
| `id` | `CarreraTaxiId` | UUID v4 generado por la aplicación; no puede estar vacío |
| `cliente` | `CarreraTaxiCliente` | Entre 3 y 100 caracteres |
| `taxi` | `CarreraTaxiTaxi` | Placa con formato `ABC123`; se normaliza a mayúsculas sin guion |
| `kilometros` | `CarreraTaxiKilometros` | Mayor que 0 y máximo 1000 |
| `barrioInicio` | `CarreraTaxiBarrio` | Entre 3 y 100 caracteres |
| `barrioLlegada` | `CarreraTaxiBarrio` | Entre 3 y 100 caracteres |
| `cantidadPasajeros` | `CarreraTaxiCantidadPasajeros` | Entre 1 y 4 |
| `taxista` | `CarreraTaxiTaxista` | Entre 3 y 100 caracteres |
| `precio` | `CarreraTaxiPrecio` | Mayor que 0 (COP) |
| `duracionMinutos` | `CarreraTaxiDuracionMinutos` | Entero mayor que 0 |

El modelo `CarreraTaxiModel` es inmutable y calcula el **precio por kilómetro**
y la **velocidad promedio** de la carrera.

### Recorrido por capas

| Capa | Elementos de CarreraTaxi |
|---|---|
| Dominio | `Domain/Models/CarreraTaxiModel.php`, 9 value objects, 10 excepciones, 3 eventos |
| Aplicación — puertos de salida | `Save`, `Update`, `GetById`, `GetAll` y `Delete` `CarreraTaxiPort` |
| Aplicación — puertos de entrada | `Create`, `Update`, `GetById`, `GetAll` y `Delete` `CarreraTaxiUseCase` |
| Aplicación — servicios | Un servicio por caso de uso, comandos y queries (CQRS), `CarreraTaxiApplicationMapper` |
| Infraestructura — adaptadores | `CarreraTaxiRepositoryMySQL` (PDO), persistence DTO, entity y mapper |
| Infraestructura — entrypoints | `CarreraTaxiController`, web requests/response, `CarreraTaxiWebMapper`, vistas `carreras/*` |
| Común | Registro en `ClassLoader` y composición en `DependencyInjection` |

### Rutas

Todas exigen sesión iniciada.

| Ruta | Método | Operación |
|---|---|---|
| `?route=carreras.create` | GET | Formulario de registro |
| `?route=carreras.store` | POST | **C** — registrar |
| `?route=carreras.show&id={id}` | GET | **R** — consultar |
| `?route=carreras.edit&id={id}` | GET | Formulario de edición |
| `?route=carreras.update` | POST | **U** — actualizar |
| `?route=carreras.delete` | POST | **D** — eliminar |
| `?route=carreras.index` | GET | **L** — listar |

### Base de datos

El script `database/schema.sql` crea la base `crud_usuarios`, las tablas `users`
y `carreras_taxi`, el usuario administrador base y tres carreras de ejemplo.

```bash
mysql -u root -p < database/schema.sql
cp .env.example .env    # y completar las credenciales de la base
```

Usuario administrador base: `admin@crud.com` / `admin12345`.

### Ejecutar con Docker

```bash
docker compose up --build
```

- Aplicación: <http://localhost:8080/public/index.php>
- MySQL queda publicado en el puerto `3307` del equipo.
- `docker compose down -v` borra la base para volver a crearla desde el script.

### Pruebas

- **Prueba de humo:** `BASE_URL=http://localhost:8080/public/index.php bash tests/smoke.sh`
  recorre login, CRUDL completo y dos reglas de dominio.
- **Postman:** importar `postman/CarreraTaxi.postman_collection.json`, ejecutar
  primero *Auth > Iniciar sesión* y luego las demás peticiones en orden.

### Integración y despliegue continuo

El workflow `.github/workflows/ci.yml` revisa la sintaxis PHP, ejecuta la prueba
de humo contra un MySQL temporal y, en cada push a `main`, llama al deploy hook
del servicio en la nube si existe el secreto `RENDER_DEPLOY_HOOK_URL`.

Para desplegar la imagen (Render u otro servicio con Docker) se configuran las
variables `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD`
apuntando a la base de datos en la nube. También se aceptan directamente las
variables `MYSQL_ADDON_*` que exporta el add-on MySQL de Clever Cloud. El
contenedor escucha en el puerto que indique la variable `PORT`.

Al arrancar, el contenedor ejecuta `php database/migrate.php`, que aplica
`database/schema.sql` sobre la base configurada (omite `CREATE DATABASE` y
`USE`, porque en la nube la base ya existe). Es idempotente.
