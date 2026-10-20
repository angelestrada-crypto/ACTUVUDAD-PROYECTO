<?php
declare(strict_types=1);

/**
 * Configuración global de la aplicación:
 * zona horaria, sesión y constantes compartidas.
 */
date_default_timezone_set('America/Lima');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const APP_NOMBRE        = 'Casos Prácticos de Geometría';
const APP_VERSION       = '1.0.0';
const BOOTSTRAP_VERSION = '5.3.3';
const PRISM_VERSION     = '1.29.0';
const LIMITE_VALOR      = 1000000; // valor máximo permitido en los formularios
