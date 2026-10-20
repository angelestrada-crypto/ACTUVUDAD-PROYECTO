<?php
/**
 * Cabecera HTML común: Bootstrap 5.3 (CDN) + Prism.js CSS.
 * Variables esperadas: $titulo_pagina (string), $usar_prism (bool).
 */
$titulo_pagina = $titulo_pagina ?? APP_NOMBRE;
$usar_prism    = $usar_prism ?? false;
$estudiante    = $_SESSION['estudiante'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($titulo_pagina) ?></title>

    <!-- Bootstrap 5.3 e íconos (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@<?= BOOTSTRAP_VERSION ?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<?php if ($usar_prism): ?>
    <!-- Prism.js: números de línea (el tema oscuro de VS Code está en estilos.css) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/<?= PRISM_VERSION ?>/plugins/line-numbers/prism-line-numbers.min.css" rel="stylesheet">
<?php endif; ?>

    <link href="assets/css/estilos.css" rel="stylesheet">
</head>
<body>
<header class="barra-superior">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <a href="index.php" class="marca"><i class="bi bi-triangle-fill"></i> <?= e(APP_NOMBRE) ?></a>
<?php if (!empty($estudiante['nombres'])): ?>
        <span class="datos-estudiante">
            <i class="bi bi-person-fill"></i> <?= e($estudiante['nombres']) ?>
<?php if (!empty($estudiante['semestre'])): ?> · Semestre <?= e($estudiante['semestre']) ?><?php endif; ?>
<?php if (!empty($estudiante['turno'])): ?> · <?= e($estudiante['turno']) ?><?php endif; ?>
        </span>
<?php endif; ?>
    </div>
</header>

<main class="container py-4">
