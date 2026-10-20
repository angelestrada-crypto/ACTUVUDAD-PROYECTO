<h1 class="titulo-menu text-center mb-4">Menú Principal</h1>

<section class="panel mb-4">
    <div class="panel-cabecera">Resolución de Ejercicios</div>
    <div class="panel-cuerpo">
        <?php foreach ($categorias as $nombreCategoria => $lista): ?>
            <h2 class="categoria-titulo">
                <i class="bi bi-folder2-open"></i> <?= e($nombreCategoria) ?>
                <span class="badge text-bg-secondary"><?= count($lista) ?></span>
            </h2>

            <?php foreach ($lista as $c): ?>
                <article class="caso-item">
                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                        <h3 class="caso-titulo">CASO <?= sprintf('%02d', $c['id']) ?>: <?= e($c['titulo']) ?></h3>
                        <span class="badge badge-categoria"><?= e($c['categoria']) ?></span>
                    </div>
                    <p class="caso-enunciado"><strong>Enunciado detallado:</strong> <?= e($c['enunciado']) ?></p>
                    <a class="btn btn-accion btn-sm" href="caso<?= $c['id'] ?>.php">
                        Ver caso <i class="bi bi-arrow-right-circle"></i>
                    </a>
                </article>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="panel">
    <div class="panel-cabecera">Datos del estudiante</div>
    <div class="panel-cuerpo">
        <?php if ($mensaje !== null): ?>
            <div class="alert alert-success py-2" role="status"><?= e($mensaje) ?></div>
        <?php endif; ?>

        <form method="post" action="index.php" class="row g-3">
            <div class="col-md-5">
                <label class="form-label fw-bold" for="nombres">APELLIDOS Y NOMBRES:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="nombres" name="nombres" maxlength="80"
                           placeholder="Ej. Pérez Quispe, Juan" value="<?= e($estudiante['nombres']) ?>">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold" for="semestre">SEMESTRE:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                    <input type="text" class="form-control" id="semestre" name="semestre" maxlength="10"
                           placeholder="Ej. IV" value="<?= e($estudiante['semestre']) ?>">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold" for="turno">TURNO:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                    <select class="form-select" id="turno" name="turno">
                        <option value="">Seleccione…</option>
                        <?php foreach ($turnos as $t): ?>
                            <option value="<?= e($t) ?>" <?= $estudiante['turno'] === $t ? 'selected' : '' ?>><?= e($t) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" name="guardar_estudiante" value="1" class="btn btn-accion">
                    <i class="bi bi-check2-circle"></i> Guardar datos
                </button>
            </div>
        </form>
    </div>
</section>
