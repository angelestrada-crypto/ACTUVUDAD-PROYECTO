# Proyecto Geometría — Casos prácticos en PHP + Bootstrap 5.3

Portal de casos prácticos de geometría con visor de código estilo VS Code y aplicaciones interactivas.

## Cómo ejecutarlo

**Opción A — Servidor integrado de PHP (PHP 8.0 o superior):**

```
cd proyecto_geometria
php -S localhost:8000
```

Abre http://localhost:8000 en el navegador.

**Opción B — XAMPP / Laragon:** copia la carpeta `proyecto_geometria` dentro de `htdocs` (o `www`) y abre `http://localhost/proyecto_geometria/`.

> Bootstrap, Bootstrap Icons y Prism.js se cargan por CDN, así que se necesita conexión a internet.

## Estructura

```
/proyecto_geometria
├── config/app.php            Variables globales y zona horaria
├── lib/funciones.php         Lógica matemática y utilidades
├── lib/casos.php             Biblioteca centralizada de casos
├── includes/                 header.php, footer.php, nav.php (plantillas)
├── controllers/              Controladores de cada tipo de página
├── views/                    Vistas HTML de cada página
├── assets/css/estilos.css    Estilos (tema oscuro VS Code, paleta del bosquejo)
├── index.php                 Página 1: menú principal
├── caso1.php … caso6.php     Página 2: visor de código y resumen
└── app_caso1.php … app_caso6.php   Página 3: formulario en vivo
```

## Agregar un caso nuevo

1. Crear la función de cálculo en `lib/funciones.php` (con su comentario `/** ... */`).
2. Registrar el caso en `lib/casos.php` con el siguiente id consecutivo.
3. Copiar `caso6.php` y `app_caso6.php` como `caso7.php` y `app_caso7.php`, cambiando el número.
4. Si el caso usa una figura nueva, agregarla en `figura_svg()` (lib/funciones.php).

La navegación anterior/siguiente se actualiza sola.
