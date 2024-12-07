<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de PI</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cálculo de PI</h1>
        
        <form method="GET" class="form-control">
            <label for="n">Número de iteraciones (n):</label>
            <input type="number" name="n" id="n" value="<?php echo isset($_GET['n']) ? $_GET['n'] : 1000; ?>" min="1">
            <button type="submit" class="btn">Calcular</button>
        </form>

        <div class="result">
            <?php
            if (isset($_GET['n'])) {
                $start = microtime(true);
                $area = 0.0;
                $n = $_GET['n'];

                for ($i = 0; $i < $n; $i++) {
                    $x = ($i + 0.5)/$n;
                    $area = $area + 1.0/(1.0 + $x*$x);
                }

                $result = $area/$n;
                $end = microtime(true);
                $exectime = $end - $start;

                echo "<div class='pi-result'>";
                echo "<h2>Resultados</h2>";
                echo "<p class='pi-value'>π ≈ " . number_format($result, 8) . "</p>";
                echo "<p class='iterations'>Iteraciones: " . number_format($n) . "</p>";
                echo "<p class='exec-time'>Tiempo de ejecución: " . number_format($exectime, 6) . " segundos</p>";
                echo "</div>";
            }
            ?>
        </div>

        <div class="info">
            <h2>Información del Servidor</h2>
            <?php
                echo "<p>Servidor: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
                echo "<p>Dirección IP: " . $_SERVER['SERVER_ADDR'] . "</p>";
                echo "<p>Versión de PHP: " . phpversion() . "</p>";
            ?>
        </div>
    </div>
</body>
</html> 