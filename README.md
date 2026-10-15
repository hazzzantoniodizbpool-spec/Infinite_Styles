# 💈 Infinite Styles - Atelier Privé (Haute Édition)
> **Práctica de Configuración:** Google Stitch MCP en VS Code + Laravel Blade + MySQL Database Sessions.

Proyecto desarrollado para integrar diseños generados mediante **Google Stitch** con **VS Code** usando el protocolo **MCP (Model Context Protocol)** y convertirlos en vistas Blade modulares y reactivas dentro de un proyecto Laravel.

---

## 🌟 Pantallas del Proyecto (Stitch → Blade)

El sistema cuenta con las 3 vistas solicitadas, conectadas de forma interactiva y con persistencia de sesiones en base de datos:

1. **Iniciar sesión / Registro de Membresía** (`/iniciar-sesion`):
   - Diseño *Obsidian & Gold* de Google Stitch.
   - Pestaña para **Iniciar sesión** (email + contraseña + recordar sesión).
   - Pestaña para **Crear Membresía VIP** (nombre, email, teléfono directo, contraseña con medidor de fortaleza de clave, selector visual de cortes/barba/facial y términos).

2. **Editar perfil VIP** (`/perfil-vip`):
   - Tarjeta exclusiva con avatar dorado del socio (*Carlos Mendoza*, `INF-8842`, *Black Diamond Member*).
   - Formulario de **Datos Personales** (bóveda cifrada, email verificado, teléfono y fecha de aniversario).
   - Preferencias de **Lounge & Atelier** (barbero titular *Mateo Rivera*, bebidas de bienvenida como Single Malt / Espresso Geisha y tratamientos de cortesía).
   - Tarjeta digital **Infinite Obsidian Pass** (*Pass Privé terminación 4021*).
   - Botón dorado para **Guardar cambios** (`PUT /perfil-vip`).
   - Accesos directos a Seguridad y Cerrar sesión.

3. **Cerrar sesión** (`/cerrar-sesion`):
   - Pantalla de confirmación *¿Deseas finalizar tu sesión?*.
   - Resumen en tiempo real de sesiones activas desde la tabla `sessions` en MySQL.
   - Opción para revocar sesiones en todos los dispositivos.
   - Botón para *Mantener sesión activa* (regresa al perfil) y *Cerrar sesión* (destruye la sesión y redirige al login).

---

## 🚀 Requisitos e Instalación

### Requisitos:
* PHP >= 8.2
* Composer
* MySQL / MariaDB (o Laragon)
* Node.js & NPM

### Pasos para ejecutar:

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/hazzzantoniodizbpool-spec/Infinite_Styles.git
   cd Infinite_Styles
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Configurar el entorno (`.env`):**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Configura tus credenciales de MySQL en el `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3307        # O 3306 según tu entorno
   DB_DATABASE=infinite_styles
   DB_USERNAME=root
   DB_PASSWORD=
   SESSION_DRIVER=database
   ```

4. **Base de Datos y Migraciones:**
   Puedes importar directamente el script SQL incluido:
   ```bash
   mysql -u root -p infinite_styles < database_infinite_styles.sql
   ```
   O ejecutar las migraciones de Laravel:
   ```bash
   php artisan migrate
   ```

5. **Compilar assets (Tailwind CSS con Vite):**
   ```bash
   npm install
   npm run build
   ```

6. **Iniciar el servidor local:**
   ```bash
   php artisan serve
   ```
   Accede en tu navegador a: [http://localhost:8000/iniciar-sesion](http://localhost:8000/iniciar-sesion)

---

## 🔑 Credenciales de Prueba (Usuario VIP)

* **Correo electrónico:** `carlos.mendoza@executive.com`
* **Contraseña:** `InfiniteVIP2026!`
* **Membresía:** `Black Diamond Member` (`INF-8842`)

---

## 🛠️ Configuración Google Stitch MCP

El archivo de configuración oficial del servidor MCP se encuentra en:
📁 [`.vscode/mcp.json`](.vscode/mcp.json)

```json
{
  "servers": {
    "stitch": {
      "type": "http",
      "url": "https://stitch.googleapis.com/mcp",
      "headers": {
        "X-Goog-Api-Key": "${input:stitch-api-key}"
      }
    }
  }
}
```

Las capturas y pantallas descargadas originalmente de Stitch se encuentran respaldadas en la carpeta:
📁 [`infinite-styles-generated/`](infinite-styles-generated/)

---

© 2026 Infinite Styles Barbershop. Todos los derechos reservados.
