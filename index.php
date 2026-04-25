<?php
$practicas = [
    21 => [
        'titulo' => 'Operaciones aritméticas',
        'descripcion' => 'Formulario para realizar suma, resta, división y exponenciación.'
    ],
    22 => [
        'titulo' => 'Fórmula general',
        'descripcion' => 'Captura de valores a, b y c para calcular x1 y x2.'
    ],
    23 => [
        'titulo' => 'Cálculo de IMC',
        'descripcion' => 'Formulario para calcular el índice de masa corporal.'
    ],
    24 => [
        'titulo' => 'Práctica 24',
        'descripcion' => 'Espacio reservado para la práctica 24.'
    ],
    25 => [
        'titulo' => 'Práctica 25',
        'descripcion' => 'Espacio reservado para la práctica 25.'
    ],
    26 => [
        'titulo' => 'Práctica 26',
        'descripcion' => 'Espacio reservado para la práctica 26.'
    ]
];

function valorPost(string $clave, string $default = ''): string {
    return isset($_POST[$clave]) ? trim((string)$_POST[$clave]) : $default;
}

$seleccion = isset($_GET['practica']) ? (int) $_GET['practica'] : null;
$practicaActual = ($seleccion && isset($practicas[$seleccion])) ? $practicas[$seleccion] : null;

$resultado = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $practicaActual) {
    switch ($seleccion) {
        case 21:
            $num1 = valorPost('num1');
            $num2 = valorPost('num2');
            $operacion = valorPost('operacion');

            if ($num1 === '' || $num2 === '') {
                $error = 'Debes capturar ambos números.';
            } elseif (!is_numeric($num1) || !is_numeric($num2)) {
                $error = 'Los valores deben ser numéricos.';
            } else {
                $n1 = (float)$num1;
                $n2 = (float)$num2;

                switch ($operacion) {
                    case 'suma':
                        $resultado = 'Resultado de la suma: ' . ($n1 + $n2);
                        break;
                    case 'resta':
                        $resultado = 'Resultado de la resta: ' . ($n1 - $n2);
                        break;
                    case 'division':
                        if ($n2 == 0.0) {
                            $error = 'No se puede dividir entre cero.';
                        } else {
                            $resultado = 'Resultado de la división: ' . ($n1 / $n2);
                        }
                        break;
                    case 'potencia':
                        $resultado = 'Resultado de la exponenciación: ' . ($n1 ** $n2);
                        break;
                    default:
                        $error = 'Selecciona una operación válida.';
                        break;
                }
            }
            break;

        case 22:
            $a = valorPost('a');
            $b = valorPost('b');
            $c = valorPost('c');

            if ($a === '' || $b === '' || $c === '') {
                $error = 'Debes capturar los valores a, b y c.';
            } elseif (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
                $error = 'Los valores a, b y c deben ser numéricos.';
            } else {
                $a = (float)$a;
                $b = (float)$b;
                $c = (float)$c;

                if ($a == 0.0) {
                    $error = 'El valor de a no puede ser 0 en la fórmula general.';
                } else {
                    $discriminante = ($b * $b) - (4 * $a * $c);

                    if ($discriminante < 0) {
                        $error = 'La ecuación no tiene soluciones reales porque el discriminante es negativo.';
                    } else {
                        $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
                        $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
                        $resultado = 'x1 = ' . round($x1, 4) . ' | x2 = ' . round($x2, 4);
                    }
                }
            }
            break;

        case 23:
            $peso = valorPost('peso');
            $altura = valorPost('altura');

            if ($peso === '' || $altura === '') {
                $error = 'Debes capturar el peso y la altura.';
            } elseif (!is_numeric($peso) || !is_numeric($altura)) {
                $error = 'Peso y altura deben ser valores numéricos.';
            } else {
                $peso = (float)$peso;
                $altura = (float)$altura;

                if ($altura <= 0) {
                    $error = 'La altura debe ser mayor que cero.';
                } else {
                    $imc = $peso / ($altura * $altura);
                    $categoria = '';

                    if ($imc < 18.5) {
                        $categoria = 'Bajo peso';
                    } elseif ($imc < 25) {
                        $categoria = 'Peso normal';
                    } elseif ($imc < 30) {
                        $categoria = 'Sobrepeso';
                    } else {
                        $categoria = 'Obesidad';
                    }

                    $resultado = 'Tu IMC es ' . round($imc, 2) . ' (' . $categoria . ').';
                }
            }
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Prácticas 21 a 26</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eef2f7, #d9e4f5);
            min-height: 100vh;
            color: #1f2937;
            padding: 30px 15px;
        }
        .contenedor { max-width: 1100px; margin: 0 auto; }
        .encabezado, .detalle {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        .encabezado { text-align: center; margin-bottom: 25px; }
        .encabezado h1 { color: #0f172a; margin-bottom: 10px; }
        .encabezado p { color: #475569; font-size: 16px; }
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }
        .tarjeta {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-left: 6px solid #2563eb;
        }
        .tarjeta:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.12);
        }
        .tarjeta h2 { font-size: 20px; margin-bottom: 10px; color: #1d4ed8; }
        .tarjeta h3 { font-size: 17px; margin-bottom: 10px; color: #0f172a; }
        .tarjeta p { color: #475569; line-height: 1.5; margin-bottom: 16px; }
        .boton, button {
            display: inline-block;
            text-decoration: none;
            background: #2563eb;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }
        .boton:hover, button:hover { background: #1d4ed8; }
        .detalle { margin-top: 30px; }
        .detalle h2 { color: #0f172a; margin-bottom: 12px; }
        .detalle p { color: #475569; line-height: 1.6; margin-bottom: 15px; }
        .volver {
            display: inline-block;
            text-decoration: none;
            background: #0f172a;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 10px;
            margin-top: 10px;
        }
        form {
            display: grid;
            gap: 12px;
            margin-top: 18px;
            max-width: 460px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
        }
        .mensaje {
            margin-top: 16px;
            padding: 14px;
            border-radius: 10px;
            font-weight: bold;
        }
        .ok {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="encabezado">
            <h1>Menú de Prácticas 21 a la 26</h1>
            <p>Este menú fue generado con PHP, utilizando programación del lado del servidor.</p>
        </div>

        <div class="menu">
            <?php foreach ($practicas as $numero => $datos): ?>
                <div class="tarjeta">
                    <h2>Práctica <?php echo $numero; ?></h2>
                    <h3><?php echo htmlspecialchars($datos['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($datos['descripcion']); ?></p>
                    <a class="boton" href="?practica=<?php echo $numero; ?>">Ver práctica</a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($practicaActual): ?>
            <div class="detalle">
                <h2>Práctica <?php echo $seleccion; ?>: <?php echo htmlspecialchars($practicaActual['titulo']); ?></h2>
                <p><?php echo htmlspecialchars($practicaActual['descripcion']); ?></p>

                <?php if ($seleccion === 21): ?>
                    <form method="post" action="?practica=21">
                        <input type="number" step="any" name="num1" placeholder="Ingresa el primer número" value="<?php echo htmlspecialchars(valorPost('num1')); ?>">
                        <input type="number" step="any" name="num2" placeholder="Ingresa el segundo número" value="<?php echo htmlspecialchars(valorPost('num2')); ?>">
                        <select name="operacion">
                            <option value="">Selecciona una operación</option>
                            <option value="suma" <?php echo valorPost('operacion') === 'suma' ? 'selected' : ''; ?>>Suma</option>
                            <option value="resta" <?php echo valorPost('operacion') === 'resta' ? 'selected' : ''; ?>>Resta</option>
                            <option value="division" <?php echo valorPost('operacion') === 'division' ? 'selected' : ''; ?>>División</option>
                            <option value="potencia" <?php echo valorPost('operacion') === 'potencia' ? 'selected' : ''; ?>>Exponenciación</option>
                        </select>
                        <button type="submit">Calcular</button>
                    </form>
                <?php elseif ($seleccion === 22): ?>
                    <form method="post" action="?practica=22">
                        <input type="number" step="any" name="a" placeholder="Valor de a" value="<?php echo htmlspecialchars(valorPost('a')); ?>">
                        <input type="number" step="any" name="b" placeholder="Valor de b" value="<?php echo htmlspecialchars(valorPost('b')); ?>">
                        <input type="number" step="any" name="c" placeholder="Valor de c" value="<?php echo htmlspecialchars(valorPost('c')); ?>">
                        <button type="submit">Calcular x1 y x2</button>
                    </form>
                <?php elseif ($seleccion === 23): ?>
                    <form method="post" action="?practica=23">
                        <input type="number" step="any" name="peso" placeholder="Peso en kilogramos" value="<?php echo htmlspecialchars(valorPost('peso')); ?>">
                        <input type="number" step="any" name="altura" placeholder="Altura en metros" value="<?php echo htmlspecialchars(valorPost('altura')); ?>">
                        <button type="submit">Calcular IMC</button>
                    </form>
                <?php else: ?>
                    <p>Aquí debes colocar el contenido real de la práctica <?php echo $seleccion; ?>.</p>
                    <p>En este momento solo dejé implementadas completamente las prácticas 21, 22 y 23.</p>
                <?php endif; ?>

                <?php if ($resultado !== ''): ?>
                    <div class="mensaje ok"><?php echo htmlspecialchars($resultado); ?></div>
                <?php endif; ?>

                <?php if ($error !== ''): ?>
                    <div class="mensaje error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <a class="volver" href="?">Volver al menú</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
