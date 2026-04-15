# Kepler One 🚀

**Kepler One** es un sistema de gestión de inventario simple y eficiente desarrollado en PHP y MySQL. Permite administrar productos y controlar sus existencias de manera sencilla a través de operaciones de entrada y salida.

## ✨ Características

- 📦 **Gestión de Productos**: Registro, edición y eliminación de productos con código, nombre, descripción y precio.
- 📉 **Control de Inventario**: Registro de entradas y salidas de mercancía.
- 🛡️ **Validación de Existencias**: Prevención de salidas de inventario si no se cuenta con las existencias necesarias.
- 📊 **Reportes Básicos**: Vista de existencias y reporte de movimientos.
- 🎨 **Interfaz Moderna**: Basado en el framework Bootstrap para una experiencia de usuario fluida.

## 🛠️ Requisitos del Sistema

- Servidor Web (Apache/Nginx)
- PHP 7.4 o superior (Compatible con PHP 8.x)
- MySQL / MariaDB
- Soporte para extensiones `mysqli`

## 🚀 Instalación

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/evilnapsis/kepler-one.git
   ```

2. **Configurar la Base de Datos**:
   - Crea una base de datos llamada `keplerone`.
   - Importa el archivo `schema.sql` ubicado en la raíz del proyecto.
   
3. **Configuración de Conexión**:
   - Edita el archivo `core/controller/Database.php` para ajustar las credenciales de tu servidor de base de datos (usuario, contraseña, host).

4. **Ejecutar**:
   - Mueve la carpeta del proyecto a tu directorio público de servidor (ej. `htdocs` en XAMPP).
   - Accede a través de tu navegador favorito: `http://localhost/kepler-one`.

## 📂 Estructura del Proyecto

El proyecto sigue una arquitectura minimalista inspirada en MVC:

- `core/`: Contiene el núcleo del sistema, controladores y modelos.
- `core/app/view/`: Archivos de vista (interfaz de usuario).
- `core/app/action/`: Lógica de procesamiento de formularios y acciones.
- `core/app/model/`: Clases de acceso a datos (ProductData, OperationData).
- `res/`: Recursos estáticos (CSS, JS, imágenes).

---
Desarrollado por [Evilnapsis](https://evilnapsis.com/).
