<?php
declare(strict_types=1);

/* =====================================================================
 * LÓGICA MATEMÁTICA DE CÁLCULO
 * Cada función resuelve un caso práctico. Estas mismas funciones son las
 * que se muestran en el visor de código de cada caso.
 * ===================================================================== */

/**
 * Calcula la superficie de un cuadrado.
 */
function calcularSuperficieCuadrado(float $lado): float
{
    return $lado * $lado;
}

/**
 * Calcula el área de un rectángulo.
 */
function calcularAreaRectangulo(float $base, float $altura): float
{
    return $base * $altura;
}

/**
 * Calcula el área de un triángulo.
 */
function calcularAreaTriangulo(float $base, float $altura): float
{
    return ($base * $altura) / 2;
}

/**
 * Calcula el área de un círculo.
 */
function calcularAreaCirculo(float $radio): float
{
    return M_PI * $radio ** 2;
}

/**
 * Calcula la hipotenusa con el teorema de Pitágoras.
 */
function calcularHipotenusa(float $cateto_a, float $cateto_b): float
{
    return sqrt($cateto_a ** 2 + $cateto_b ** 2);
}

/**
 * Calcula el volumen de un cilindro.
 */
function calcularVolumenCilindro(float $radio, float $altura): float
{
    return M_PI * $radio ** 2 * $altura;
}

/* =====================================================================
 * BIBLIOTECA DE CASOS Y NAVEGACIÓN
 * ===================================================================== */

/** Devuelve todos los casos (se carga una sola vez desde lib/casos.php). */
function obtener_casos(): array
{
    static $casos = null;
    if ($casos === null) {
        $casos = require_once __DIR__ . '/casos.php';
    }
    return $casos;
}

function obtener_caso(int $id): ?array
{
    return obtener_casos()[$id] ?? null;
}

function obtener_caso_anterior(int $id): ?array
{
    return obtener_caso($id - 1);
}

function obtener_caso_siguiente(int $id): ?array
{
    return obtener_caso($id + 1);
}

/** Agrupa los casos por categoría para el menú principal. */
function agrupar_casos_por_categoria(): array
{
    $grupos = [];
    foreach (obtener_casos() as $caso) {
        $grupos[$caso['categoria']][] = $caso;
    }
    return $grupos;
}

/* =====================================================================
 * UTILIDADES
 * ===================================================================== */

/** Escapa texto para imprimirlo de forma segura en HTML. */
function e(?string $texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Formatea un número: 100 → "100", 78.5398 → "78.54". */
function formatear_numero(float $numero, int $decimales = 2): string
{
    $texto = number_format($numero, $decimales, '.', ',');
    $sufijo = '.' . str_repeat('0', $decimales);
    if ($decimales > 0 && str_ends_with($texto, $sufijo)) {
        return substr($texto, 0, -strlen($sufijo));
    }
    return $texto;
}

/** Convierte una entrada de formulario en número (acepta coma decimal). */
function leer_numero(mixed $valor): ?float
{
    if (!is_string($valor)) {
        return null;
    }
    $valor = str_replace(',', '.', trim($valor));
    if ($valor === '') {
        return null;
    }
    $numero = filter_var($valor, FILTER_VALIDATE_FLOAT);
    if ($numero === false || !is_finite($numero)) {
        return null;
    }
    return (float) $numero;
}

/** Limpia un texto de formulario y limita su longitud. */
function limpiar_texto(mixed $valor, int $maximo = 80): string
{
    if (!is_string($valor)) {
        return '';
    }
    return mb_substr(trim(strip_tags($valor)), 0, $maximo);
}

/** Valores de ejemplo de un caso: ['lado' => 10]. */
function valores_ejemplo(array $caso): array
{
    $valores = [];
    foreach ($caso['parametros'] as $parametro) {
        $valores[$parametro['nombre']] = (float) $parametro['ejemplo'];
    }
    return $valores;
}

/** Ejecuta la función de cálculo del caso con los valores dados. */
function ejecutar_caso(array $caso, array $valores): float
{
    $argumentos = [];
    foreach ($caso['parametros'] as $parametro) {
        $argumentos[] = $valores[$parametro['nombre']];
    }
    return (float) call_user_func_array($caso['funcion'], $argumentos);
}

/* =====================================================================
 * VISOR DE CÓDIGO
 * ===================================================================== */

/** Extrae el código fuente real de una función (con su comentario). */
function obtener_codigo_funcion(string $nombre): string
{
    $reflexion = new ReflectionFunction($nombre);
    $lineas    = file($reflexion->getFileName(), FILE_IGNORE_NEW_LINES);
    $inicio    = $reflexion->getStartLine() - 1;
    $cantidad  = $reflexion->getEndLine() - $inicio;
    $cuerpo    = implode("\n", array_slice($lineas, $inicio, $cantidad));
    $doc       = $reflexion->getDocComment();

    return ($doc !== false ? $doc . "\n" : '') . $cuerpo;
}

/** Arma el código COMPLETO de la aplicación del caso (lógica + formulario + resultado). */
function generar_codigo_completo(array $caso): string
{
    $lecturas = $campos = '';
    $argumentos = $validaciones = [];

    foreach ($caso['parametros'] as $p) {
        $n = $p['nombre'];
        $lecturas .= '    $' . $n . ' = (float) str_replace(\',\', \'.\', $_POST[\'' . $n . '\'] ?? \'0\');' . "\n";
        $argumentos[]   = '$' . $n;
        $validaciones[] = '$' . $n . ' <= 0';
        $campos .= '        <div class="mb-3">' . "\n"
            . '            <label class="form-label" for="' . $n . '">' . $p['etiqueta'] . ' (' . $p['unidad'] . ')</label>' . "\n"
            . '            <input type="number" step="any" min="0" class="form-control" id="' . $n . '" name="' . $n . '"' . "\n"
            . '                   value="<?= htmlspecialchars($_POST[\'' . $n . '\'] ?? \'' . $p['ejemplo'] . '\') ?>" required>' . "\n"
            . '        </div>' . "\n";
    }

    $plantilla = <<<'PHPCODE'
<?php
// {{ARCHIVO}} — {{TITULO}}
// Enunciado: {{ENUNCIADO}}

{{FUNCION}}

$resultado = null;
$error     = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
{{LECTURAS}}
    if ({{VALIDACION}}) {
        $error = 'Ingrese valores mayores que cero.';
    } else {
        $resultado = {{LLAMADA}};
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{TITULO}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h1 class="h3">{{TITULO}}</h1>
    <p>{{ENUNCIADO}}</p>

    <form method="post" class="mb-3">
{{CAMPOS}}        <button type="submit" class="btn btn-success">Calcular</button>
    </form>

    <?php if ($error !== null): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($resultado !== null): ?>
        <div class="alert alert-success">
            {{ETIQUETA}}: <strong><?= round($resultado, 2) ?> {{UNIDAD}}</strong>
        </div>
    <?php endif; ?>
</body>
</html>
PHPCODE;

    return str_replace(
        ['{{ARCHIVO}}', '{{TITULO}}', '{{ENUNCIADO}}', '{{FUNCION}}', '{{LECTURAS}}', '{{VALIDACION}}', '{{LLAMADA}}', '{{CAMPOS}}', '{{ETIQUETA}}', '{{UNIDAD}}'],
        [
            'caso' . $caso['id'] . '.php',
            $caso['titulo'],
            $caso['enunciado'],
            obtener_codigo_funcion($caso['funcion']),
            $lecturas,
            implode(' || ', $validaciones),
            $caso['funcion'] . '(' . implode(', ', $argumentos) . ')',
            $campos,
            $caso['resultado_etiqueta'],
            $caso['unidad_resultado'],
        ],
        $plantilla
    );
}

/** Arma el código PHP que se muestra: la función + un ejemplo de uso. */
function generar_codigo_caso(array $caso): string
{
    $codigo = "<?php\n";
    $codigo .= obtener_codigo_funcion($caso['funcion']) . "\n\n";
    $codigo .= "// Ejemplo de uso\n";

    $argumentos = [];
    foreach ($caso['parametros'] as $parametro) {
        $codigo .= '$' . $parametro['nombre'] . ' = ' . $parametro['ejemplo'] . ";\n";
        $argumentos[] = '$' . $parametro['nombre'];
    }

    $codigo .= '$resultado = ' . $caso['funcion'] . '(' . implode(', ', $argumentos) . ");\n";
    $codigo .= 'echo "' . $caso['resultado_etiqueta'] . ': " . round($resultado, 2) . " '
        . $caso['unidad_resultado'] . "\";\n";
    $codigo .= '?>';

    return $codigo;
}

/* =====================================================================
 * FIGURAS (SVG)
 * ===================================================================== */

/** Escala dos medidas para que quepan en un área máxima. */
function escalar_dimensiones(float $a, float $b, float $maxA, float $maxB, float $minimo = 28.0): array
{
    $factor = min($maxA / $a, $maxB / $b);
    return [max($minimo, $a * $factor), max($minimo, $b * $factor)];
}

/** Dibuja la figura del caso en SVG según los valores recibidos. */
function figura_svg(string $tipo, array $v, string $unidad = 'm'): string
{
    $ancho   = 260;
    $zona    = 150; // alto disponible para la figura (el resto es para el texto)
    $n       = static fn(string $clave): string => formatear_numero((float) ($v[$clave] ?? 0)) . ' ' . $unidad;
    $forma   = '';
    $leyenda = '';

    switch ($tipo) {
        case 'cuadrado':
            $lado    = 110;
            $x       = ($ancho - $lado) / 2;
            $y       = ($zona - $lado) / 2 + 4;
            $forma   = sprintf('<rect class="fig-shape" x="%.1f" y="%.1f" width="%d" height="%d"/>', $x, $y, $lado, $lado);
            $leyenda = 'lado = ' . $n('lado');
            break;

        case 'rectangulo':
            [$w, $h] = escalar_dimensiones((float) $v['base'], (float) $v['altura'], 190, 110);
            $x       = ($ancho - $w) / 2;
            $y       = ($zona - $h) / 2 + 4;
            $forma   = sprintf('<rect class="fig-shape" x="%.1f" y="%.1f" width="%.1f" height="%.1f"/>', $x, $y, $w, $h);
            $leyenda = 'base = ' . $n('base') . '   altura = ' . $n('altura');
            break;

        case 'triangulo':
            [$w, $h] = escalar_dimensiones((float) $v['base'], (float) $v['altura'], 190, 110);
            $x       = ($ancho - $w) / 2;
            $y       = ($zona - $h) / 2 + 4;
            $apice   = $x + $w * 0.35;
            $forma   = sprintf(
                '<polygon class="fig-shape" points="%.1f,%.1f %.1f,%.1f %.1f,%.1f"/>'
                . '<line class="fig-aux" x1="%.1f" y1="%.1f" x2="%.1f" y2="%.1f"/>',
                $x, $y + $h, $x + $w, $y + $h, $apice, $y,
                $apice, $y, $apice, $y + $h
            );
            $leyenda = 'base = ' . $n('base') . '   altura = ' . $n('altura');
            break;

        case 'circulo':
            $r       = 62;
            $cx      = $ancho / 2;
            $cy      = $zona / 2 + 4;
            $forma   = sprintf(
                '<circle class="fig-shape" cx="%.1f" cy="%.1f" r="%d"/>'
                . '<line class="fig-aux" x1="%.1f" y1="%.1f" x2="%.1f" y2="%.1f"/>'
                . '<circle cx="%.1f" cy="%.1f" r="3" fill="#14463a"/>',
                $cx, $cy, $r, $cx, $cy, $cx + $r, $cy, $cx, $cy
            );
            $leyenda = 'radio = ' . $n('radio');
            break;

        case 'hipotenusa':
            [$w, $h] = escalar_dimensiones((float) $v['cateto_b'], (float) $v['cateto_a'], 190, 110);
            $x       = ($ancho - $w) / 2;
            $y       = ($zona - $h) / 2 + 4;
            $marca   = 12;
            $forma   = sprintf(
                '<polygon class="fig-shape" points="%.1f,%.1f %.1f,%.1f %.1f,%.1f"/>'
                . '<polyline class="fig-aux" points="%.1f,%.1f %.1f,%.1f %.1f,%.1f"/>',
                $x, $y + $h, $x + $w, $y + $h, $x, $y,
                $x + $marca, $y + $h, $x + $marca, $y + $h - $marca, $x, $y + $h - $marca
            );
            $leyenda = 'a = ' . $n('cateto_a') . '   b = ' . $n('cateto_b');
            break;

        case 'cilindro':
            [$w, $alto] = escalar_dimensiones(2 * (float) $v['radio'], (float) $v['altura'], 130, 90);
            $rx      = $w / 2;
            $ry      = max(8.0, $w * 0.2);
            $x       = ($ancho - $w) / 2;
            $y       = ($zona - ($alto + 2 * $ry)) / 2 + 4;
            $forma   = sprintf(
                '<path class="fig-shape" d="M %.1f %.1f v %.1f a %.1f %.1f 0 0 0 %.1f 0 v %.1f"/>'
                . '<ellipse class="fig-shape" cx="%.1f" cy="%.1f" rx="%.1f" ry="%.1f"/>',
                $x, $y + $ry, $alto, $rx, $ry, $w, -$alto,
                $x + $rx, $y + $ry, $rx, $ry
            );
            $leyenda = 'radio = ' . $n('radio') . '   altura = ' . $n('altura');
            break;
    }

    return sprintf(
        '<svg class="figura-svg" viewBox="0 0 %d 190" role="img" aria-label="Figura del caso" xmlns="http://www.w3.org/2000/svg">'
        . '%s<text class="fig-label" x="%d" y="178" text-anchor="middle">%s</text></svg>',
        $ancho,
        $forma,
        $ancho / 2,
        e($leyenda)
    );
}
