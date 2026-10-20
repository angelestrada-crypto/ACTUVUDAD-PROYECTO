<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../lib/funciones.php';
require_once __DIR__ . '/caso_controller.php'; // reutiliza mostrarError404()

/** Controlador de la Página 3: aplicación con formulario en vivo. */
function mostrarAplicacion(int $id): void
{
    $caso = obtener_caso($id);
    if ($caso === null) {
        mostrarError404();
        return;
    }

    $caso_id   = $id;
    $entradas  = []; // texto tal como lo escribió el usuario (para repoblar el formulario)
    $valores   = []; // números ya validados
    $errores   = [];
    $resultado = null;

    foreach ($caso['parametros'] as $parametro) {
        $entradas[$parametro['nombre']] = (string) $parametro['ejemplo'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($caso['parametros'] as $parametro) {
            $nombre = $parametro['nombre'];
            $bruto  = $_POST[$nombre] ?? '';
            $entradas[$nombre] = is_string($bruto) ? mb_substr(trim($bruto), 0, 20) : '';
            $numero = leer_numero($bruto);

            if ($numero === null) {
                $errores[] = 'El campo «' . $parametro['etiqueta'] . '» debe ser un número válido.';
            } elseif ($numero <= 0) {
                $errores[] = 'El campo «' . $parametro['etiqueta'] . '» debe ser mayor que cero.';
            } elseif ($numero > LIMITE_VALOR) {
                $errores[] = 'El campo «' . $parametro['etiqueta'] . '» no puede superar ' . number_format(LIMITE_VALOR) . '.';
            } else {
                $valores[$nombre] = $numero;
            }
        }

        if ($errores === []) {
            $resultado = ejecutar_caso($caso, $valores);
        }
    }

    $figura = $resultado !== null ? figura_svg($caso['figura'], $valores) : '';

    $titulo_pagina = 'Aplicación Caso ' . $id . ' | ' . APP_NOMBRE;
    $usar_prism    = false;

    include_once __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../views/app_view.php';
    include_once __DIR__ . '/../includes/nav.php';
    include_once __DIR__ . '/../includes/footer.php';
}
