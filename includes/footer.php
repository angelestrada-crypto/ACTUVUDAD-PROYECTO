<?php
/**
 * Pie de página común: Bootstrap 5.3 JS y Prism.js (cuando se necesita).
 * Variable esperada: $usar_prism (bool).
 */
$usar_prism = $usar_prism ?? false;
?>
</main>

<footer class="pie-pagina">
    <div class="container text-center">
        <?= e(APP_NOMBRE) ?> · PHP <?= e(PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION) ?> + Bootstrap <?= e(BOOTSTRAP_VERSION) ?> · <?= date('Y') ?>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@<?= BOOTSTRAP_VERSION ?>/dist/js/bootstrap.bundle.min.js"></script>
<?php if ($usar_prism): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/<?= PRISM_VERSION ?>/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/<?= PRISM_VERSION ?>/components/prism-markup-templating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/<?= PRISM_VERSION ?>/components/prism-php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/<?= PRISM_VERSION ?>/plugins/line-numbers/prism-line-numbers.min.js"></script>
<script>
// Recalcula los números de línea al cambiar de pestaña y permite copiar el código visible
document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function (boton) {
    boton.addEventListener('shown.bs.tab', function () {
        var pre = document.querySelector('.tab-pane.active pre');
        if (pre && window.Prism && Prism.plugins.lineNumbers) { Prism.plugins.lineNumbers.resize(pre); }
    });
});
var btnCopiar = document.getElementById('btn-copiar');
if (btnCopiar) {
    btnCopiar.addEventListener('click', function () {
        var codigo = document.querySelector('.tab-pane.active code').innerText;
        navigator.clipboard.writeText(codigo).then(function () {
            btnCopiar.innerHTML = '<i class="bi bi-check2"></i> ¡Copiado!';
            setTimeout(function () { btnCopiar.innerHTML = '<i class="bi bi-clipboard"></i> Copiar'; }, 1800);
        });
    });
}
</script>
<?php endif; ?>
</body>
</html>
