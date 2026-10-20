<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="titulo-pagina mb-0">Aplicación — Caso <?= $caso['id'] ?>: <?= e($caso['titulo']) ?></h1>
</div>

<section class="marco-app">
    <h2 class="h5 fw-bold text-uppercase mb-1" style="color: var(--pizarra);">Ejecución de la aplicación</h2>
    <p class="text-secondary"><?= e($caso['enunciado']) ?></p>

    <?php if ($errores !== []): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-md-6">
            <form method="post" action="app_caso<?= $caso['id'] ?>.php">
                <?php foreach ($caso['parametros'] as $p): ?>
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="<?= e($p['nombre']) ?>"><?= e($p['etiqueta']) ?></label>
                        <div class="input-group">
                            <input type="number" step="any" min="0" required class="form-control"
                                   id="<?= e($p['nombre']) ?>" name="<?= e($p['nombre']) ?>"
                                   value="<?= e($entradas[$p['nombre']]) ?>">
                            <span class="input-group-text"><?= e($p['unidad']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-acceso" style="width:auto;">
                        <i class="bi bi-calculator"></i> Calcular
                    </button>
                    <a href="app_caso<?= $caso['id'] ?>.php" class="btn btn-outline-secondary">Limpiar</a>
                </div>
                <p class="small text-secondary mt-3 mb-0">Fórmula: <code><?= e($caso['formula']) ?></code></p>
            </form>
        </div>

        <div class="col-md-6">
            <?php if ($resultado !== null): ?>
                <div class="figura-wrap mt-0"><?= $figura ?></div>
                <div class="resultado-grande">
                    <?= e($caso['resultado_etiqueta']) ?>: <?= e(formatear_numero($resultado)) ?> <?= e($caso['unidad_resultado']) ?>
                </div>
            <?php else: ?>
                <div class="caja-enunciado text-center">
                    <i class="bi bi-info-circle"></i> Ingresa los datos y presiona <strong>Calcular</strong> para ver el resultado.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<div class="barra-enlaces">
    <a class="btn btn-accion" href="caso<?= $caso['id'] ?>.php">
        <i class="bi bi-chevron-left"></i> Volver a la pág. anterior (Caso <?= $caso['id'] ?>)
    </a>
    <a class="btn btn-accion" href="index.php">
        Ir a la página principal (Menú) <i class="bi bi-chevron-right"></i>
    </a>
</div>
