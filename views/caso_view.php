<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="titulo-pagina mb-0">Caso <?= $caso['id'] ?>: <?= e($caso['titulo']) ?></h1>
    <a href="index.php" class="btn btn-accion"><i class="bi bi-arrow-return-left"></i> Volver Pág. Principal</a>
</div>

<section class="caja-enunciado mb-3">
    <strong>ENUNCIADO:</strong><br>
    <?= e($caso['enunciado']) ?>
</section>

<div class="row g-3">
    <!-- Visualización de código (estilo VS Code) -->
    <div class="col-lg-6">
        <div class="panel h-100">
            <div class="panel-cabecera">Visualización de códigos (PHP)</div>
            <div class="editor-vscode">
                <div class="editor-barra">
                    <span class="punto rojo"></span><span class="punto amarillo"></span><span class="punto verde"></span>
                    <ul class="nav pestanas-codigo" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-completo" data-bs-toggle="tab" data-bs-target="#codigo-completo" type="button" role="tab">caso<?= $caso['id'] ?>.php (completo)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-funcion" data-bs-toggle="tab" data-bs-target="#codigo-funcion" type="button" role="tab">Solo la función</button>
                        </li>
                    </ul>
                    <button type="button" class="btn-copiar ms-auto" id="btn-copiar" title="Copiar el código visible">
                        <i class="bi bi-clipboard"></i> Copiar
                    </button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="codigo-completo" role="tabpanel" tabindex="0">
                        <pre class="line-numbers language-php" tabindex="0"><code class="language-php"><?= e($codigo_completo) ?></code></pre>
                    </div>
                    <div class="tab-pane fade" id="codigo-funcion" role="tabpanel" tabindex="0">
                        <pre class="line-numbers language-php" tabindex="0"><code class="language-php"><?= e($codigo) ?></code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Área de resultados -->
    <div class="col-lg-6">
        <div class="panel h-100">
            <div class="panel-cabecera">Área de resultados</div>
            <div class="panel-cuerpo">
                <table class="table table-sm table-bordered tabla-resultados mb-0">
                    <tbody>
                    <?php foreach ($caso['parametros'] as $p): ?>
                        <tr>
                            <th scope="row"><?= e($p['etiqueta']) ?></th>
                            <td><?= e(formatear_numero($valores[$p['nombre']])) ?> <?= e($p['unidad']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                        <tr>
                            <th scope="row">Fórmula</th>
                            <td><code><?= e($caso['formula']) ?></code></td>
                        </tr>
                    </tbody>
                </table>

                <div class="figura-wrap"><?= $figura ?></div>

                <div class="resultado-grande">
                    <?= e($caso['resultado_etiqueta']) ?>: <?= e(formatear_numero($resultado)) ?> <?= e($caso['unidad_resultado']) ?>
                </div>

                <a class="btn btn-acceso mt-3" href="app_caso<?= $caso['id'] ?>.php">
                    Acceder a la aplicación (Pág. 3) <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
