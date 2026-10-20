<?php
declare(strict_types=1);

/**
 * Biblioteca centralizada de casos prácticos.
 *
 * Para agregar un caso nuevo:
 *   1. Crear su función de cálculo en lib/funciones.php.
 *   2. Agregarlo aquí con el siguiente id consecutivo.
 *   3. Crear caso{id}.php y app_caso{id}.php (copiar los del caso anterior
 *      y cambiar solo el número).
 *
 * Los ids deben ser consecutivos (1, 2, 3...) para que la navegación
 * "Caso anterior / Caso siguiente" funcione automáticamente.
 */
return [
    1 => [
        'id'                 => 1,
        'titulo'             => 'Superficie del Cuadrado',
        'categoria'          => 'Áreas de figuras planas',
        'enunciado'          => 'Calcular la superficie del cuadrado dado el valor de uno de sus lados de 10 metros.',
        'funcion'            => 'calcularSuperficieCuadrado',
        'parametros'         => [
            ['nombre' => 'lado', 'etiqueta' => 'Lado del cuadrado', 'unidad' => 'm', 'ejemplo' => 10],
        ],
        'formula'            => 'A = lado²',
        'resultado_etiqueta' => 'Área calculada',
        'unidad_resultado'   => 'm²',
        'figura'             => 'cuadrado',
    ],
    2 => [
        'id'                 => 2,
        'titulo'             => 'Área del Rectángulo',
        'categoria'          => 'Áreas de figuras planas',
        'enunciado'          => 'Calcular el área de un rectángulo cuya base mide 8 metros y su altura mide 5 metros.',
        'funcion'            => 'calcularAreaRectangulo',
        'parametros'         => [
            ['nombre' => 'base',   'etiqueta' => 'Base del rectángulo',   'unidad' => 'm', 'ejemplo' => 8],
            ['nombre' => 'altura', 'etiqueta' => 'Altura del rectángulo', 'unidad' => 'm', 'ejemplo' => 5],
        ],
        'formula'            => 'A = base × altura',
        'resultado_etiqueta' => 'Área calculada',
        'unidad_resultado'   => 'm²',
        'figura'             => 'rectangulo',
    ],
    3 => [
        'id'                 => 3,
        'titulo'             => 'Área del Triángulo',
        'categoria'          => 'Áreas de figuras planas',
        'enunciado'          => 'Calcular el área de un triángulo que tiene 12 metros de base y 7 metros de altura.',
        'funcion'            => 'calcularAreaTriangulo',
        'parametros'         => [
            ['nombre' => 'base',   'etiqueta' => 'Base del triángulo',   'unidad' => 'm', 'ejemplo' => 12],
            ['nombre' => 'altura', 'etiqueta' => 'Altura del triángulo', 'unidad' => 'm', 'ejemplo' => 7],
        ],
        'formula'            => 'A = (base × altura) / 2',
        'resultado_etiqueta' => 'Área calculada',
        'unidad_resultado'   => 'm²',
        'figura'             => 'triangulo',
    ],
    4 => [
        'id'                 => 4,
        'titulo'             => 'Área del Círculo',
        'categoria'          => 'Áreas de figuras planas',
        'enunciado'          => 'Calcular el área de un círculo cuyo radio mide 5 metros.',
        'funcion'            => 'calcularAreaCirculo',
        'parametros'         => [
            ['nombre' => 'radio', 'etiqueta' => 'Radio del círculo', 'unidad' => 'm', 'ejemplo' => 5],
        ],
        'formula'            => 'A = π × radio²',
        'resultado_etiqueta' => 'Área calculada',
        'unidad_resultado'   => 'm²',
        'figura'             => 'circulo',
    ],
    5 => [
        'id'                 => 5,
        'titulo'             => 'Hipotenusa del Triángulo Rectángulo',
        'categoria'          => 'Triángulos rectángulos',
        'enunciado'          => 'Calcular la longitud de la hipotenusa de un triángulo rectángulo cuyos catetos miden 3 y 4 metros.',
        'funcion'            => 'calcularHipotenusa',
        'parametros'         => [
            ['nombre' => 'cateto_a', 'etiqueta' => 'Cateto a', 'unidad' => 'm', 'ejemplo' => 3],
            ['nombre' => 'cateto_b', 'etiqueta' => 'Cateto b', 'unidad' => 'm', 'ejemplo' => 4],
        ],
        'formula'            => 'c = √(a² + b²)',
        'resultado_etiqueta' => 'Hipotenusa calculada',
        'unidad_resultado'   => 'm',
        'figura'             => 'hipotenusa',
    ],
    6 => [
        'id'                 => 6,
        'titulo'             => 'Volumen del Cilindro',
        'categoria'          => 'Volúmenes',
        'enunciado'          => 'Calcular el volumen de un cilindro cuya base tiene 3 metros de radio y cuya altura es de 10 metros.',
        'funcion'            => 'calcularVolumenCilindro',
        'parametros'         => [
            ['nombre' => 'radio',  'etiqueta' => 'Radio de la base',   'unidad' => 'm', 'ejemplo' => 3],
            ['nombre' => 'altura', 'etiqueta' => 'Altura del cilindro', 'unidad' => 'm', 'ejemplo' => 10],
        ],
        'formula'            => 'V = π × radio² × altura',
        'resultado_etiqueta' => 'Volumen calculado',
        'unidad_resultado'   => 'm³',
        'figura'             => 'cilindro',
    ],
];
