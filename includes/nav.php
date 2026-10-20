<?php
/**
 * Panel de control de navegación (menú / caso anterior / caso siguiente).
 * Variable esperada: $caso_id (int).
 */
$anterior  = obtener_caso_anterior($caso_id);
$siguiente = obtener_caso_siguiente($caso_id);
?>
<nav class="panel-control mt-4" aria-label="Navegación entre casos">
    <?php if ($anterior !== null): ?>
        <a class="btn btn-nav" href="caso<?= $anterior['id'] ?>.php">
            <i class="bi bi-arrow-left"></i> Caso Anterior
        </a>
    <?php else: ?>
        <span class="btn btn-nav disabled" aria-disabled="true"><i class="bi bi-arrow-left"></i> Caso Anterior</span>
    <?php endif; ?>

    <a class="btn btn-nav" href="index.php"><i class="bi bi-grid-fill"></i> Menú Principal</a>

    <?php if ($siguiente !== null): ?>
        <a class="btn btn-nav" href="caso<?= $siguiente['id'] ?>.php">
            Caso Siguiente <i class="bi bi-arrow-right"></i>
        </a>
    <?php else: ?>
        <span class="btn btn-nav disabled" aria-disabled="true">Caso Siguiente <i class="bi bi-arrow-right"></i></span>
    <?php endif; ?>
</nav>
