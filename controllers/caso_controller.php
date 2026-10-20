<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../lib/funciones.php';

/** Controlador de la Página 2: visor de código y resumen del caso. */
function mostrarCaso(int $id): void
{
    $caso = obtener_caso($id);
    if ($caso === null) {
        mostrarError404();
        return;
    }

    $caso_id   = $id;
    $valores   = valores_ejemplo($caso);
    $resultado = ejecutar_caso($caso, $valores);
    $codigo    = generar_codigo_caso($caso);
    $codigo_completo = generar_codigo_completo($caso);
    $figura    = figura_svg($caso['figura'], $valores);

    $titulo_pagina = 'Caso ' . $id . ': ' . $caso['titulo'] . ' | ' . APP_NOMBRE;
    $usar_prism    = true;

    include_once __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../views/caso_view.php';
    include_once __DIR__ . '/../includes/nav.php';
    include_once __DIR__ . '/../includes/footer.php';
}

/** Respuesta cuando el caso solicitado no existe. */
function mostrarError404(): void
{
    http_response_code(404);
    $titulo_pagina = 'Caso no encontrado | ' . APP_NOMBRE;
    $usar_prism    = false;

    include_once __DIR__ . '/../includes/header.php';
    echo '<div class="panel"><div class="panel-cuerpo text-center">'
        . '<h1 class="h3">Caso no encontrado</h1>'
        . '<a class="btn btn-accion mt-2" href="index.php">Volver al menú principal</a>'
        . '</div></div>';
    include_once __DIR__ . '/../includes/footer.php';
}
