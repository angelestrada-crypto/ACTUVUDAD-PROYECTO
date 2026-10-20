<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../lib/funciones.php';

/** Controlador de la Página 1: menú principal. */
function mostrarMenu(): void
{
    $turnos = ['Mañana', 'Tarde', 'Noche'];

    // Guardar datos del estudiante (Apellidos y Nombres, Semestre, Turno)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_estudiante'])) {
        $turno = limpiar_texto($_POST['turno'] ?? '', 20);
        $_SESSION['estudiante'] = [
            'nombres'  => limpiar_texto($_POST['nombres'] ?? ''),
            'semestre' => limpiar_texto($_POST['semestre'] ?? '', 10),
            'turno'    => in_array($turno, $turnos, true) ? $turno : '',
        ];
        $_SESSION['mensaje'] = 'Datos guardados correctamente.';
        header('Location: index.php');
        exit;
    }

    $mensaje = $_SESSION['mensaje'] ?? null;
    unset($_SESSION['mensaje']);

    $estudiante = $_SESSION['estudiante'] ?? ['nombres' => '', 'semestre' => '', 'turno' => ''];
    $categorias = agrupar_casos_por_categoria();

    $titulo_pagina = 'Menú Principal | ' . APP_NOMBRE;
    $usar_prism    = false;

    include_once __DIR__ . '/../includes/header.php';
    include __DIR__ . '/../views/menu_view.php';
    include_once __DIR__ . '/../includes/footer.php';
}
