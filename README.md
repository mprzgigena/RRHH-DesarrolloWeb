
# Ejercicios Prácticos de Desarrollo Web con Symfony

Este repositorio documenta y contiene diversos ejercicios prácticos desarrollados con el framework Symfony, abarcando desde los fundamentos del routing hasta la implementación de funcionalidades avanzadas como reportes y formularios dinámicos. Cada sección resume las características implementadas y los principales aprendizajes.

## Contenido del Proyecto:

### Practico 1: Routing en Symfony
* **Implementación:** Se exploró la creación de rutas personalizadas para `Saludo y Despedida`, `Estado de Ánimo`, y `Mensaje Aleatorio`. Se incluyeron rutas con parámetros para una `API JSON` (requiriendo un ID de usuario) y la comprobación de `Condicionales` (requiriendo una edad para determinar mayoría).
* **Aprendizaje:**
    * Fundamentos del sistema de rutas en Symfony (`#[Route]`).
    * Uso de parámetros de ruta y validación básica.
    * Manejo de diferentes tipos de respuestas HTTP (HTML, JSON).

### Practico 2: Motor de Plantillas Twig
* **Implementación:** Desarrollo de `Listado de Estudiantes` (Ejercicios 1, 2 y 3), `Cursos Agrupados` (Ejercicio 4) y aplicación de `Herencia Vertical` en plantillas (Ejercicio 4 - Parte iii).
* **Aprendizaje:**
    * Manejo de Twig para la renderización de vistas dinámicas.
    * Uso de bucles (`for`), condicionales (`if`), y filtros de Twig.
    * Implementación de la herencia de plantillas (`extends`, `block`) para la reutilización de código y estructuración de layouts.

### Practico 3: Servicios en Symfony
* **Implementación:** Creación de una `Calculadora` (Ejercicio 1) y un servicio de `Formato de Fecha` (Ejercicio 2).
* **Aprendizaje:**
    * Concepto de servicios y el contenedor de servicios de Symfony.
    * Creación de servicios personalizados y su registro.
    * Inyección de dependencias para reutilizar lógica de negocio.

### Practico 4: Doctrine y Catálogo de Películas
* **Implementación:** Desarrollo de un catálogo de `Peliculas` con funcionalidades de `Listado`, `Búsqueda` y `Filtrado`.
* **Aprendizaje:**
    * Uso del ORM Doctrine para la persistencia de datos y mapeo de entidades a tablas de base de datos.
    * Creación y gestión de entidades y repositorios.
    * Construcción de consultas complejas con Doctrine Query Builder (DQL) para filtrado y búsqueda.

### Practico 5: Formularios en Symfony (Entidad Países)
* **Implementación:** Desarrollo de un sistema de `Gestión de Países` (CRUD completo).
* **Aprendizaje:**
    * Creación de formularios con Symfony para la manipulación de entidades.
    * Validación de datos en formularios.
    * Integración de formularios con Doctrine para la persistencia (creación, edición, eliminación).

### Practico 6: Seguridad y Autenticación
* **Implementación:** Configuración del `Acceso a la aplicación` mediante un sistema de autenticación de usuarios.
* **Aprendizaje:**
    * Configuración del componente de seguridad de Symfony.
    * Implementación de autenticación basada en formularios.
    * Gestión de usuarios y roles para controlar el acceso a diferentes partes de la aplicación.

### Practico 7: Formularios Embebidos (Departamentos y Empleados Dinámicos)
* **Implementación:** Desarrollo de la `Gestión de Departamentos` con la capacidad de añadir y eliminar `Empleados Dinámicos` dentro del mismo formulario.
* **Aprendizaje:**
    * Uso de `CollectionType` de Symfony para formularios embebidos (relaciones uno-a-muchos).
    * Manipulación dinámica de campos de formulario en el lado del cliente con JavaScript (añadir/eliminar elementos).
    * Sincronización de formularios complejos con la base de datos a través de Doctrine.

### Practico 8: Reportes (Excel y PDF)
* **Implementación:** Generación de un `Reporte de Provincias` que incluye `Filtros` avanzados y funcionalidades de `Exportación` a formatos Excel y PDF.
* **Aprendizaje:**
    * Integración de librerías de terceros (`PhpSpreadsheet` para Excel, `Dompdf` para PDF).
    * Creación de reportes dinámicos basados en criterios de filtrado.
    * Manejo de diferentes tipos de respuestas para la descarga de archivos (StreamedResponse, PDF Response).
    * Depuración de la lógica de formularios y la generación de reportes.

---
