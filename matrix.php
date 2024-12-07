<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests de Rendimiento - Matrices</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Tests Server</h2>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="page.php">
                        <i class="fas fa-calculator"></i>
                        <span>Cálculo de PI</span>
                    </a>
                </li>
                <li class="active">
                    <a href="matrix.php">
                        <i class="fas fa-table"></i>
                        <span>Multiplicación de Matrices</span>
                    </a>
                </li>
                <li>
                    <a href="sort.php">
                        <i class="fas fa-sort"></i>
                        <span>Ordenamiento</span>
                    </a>
                </li>
                <li>
                    <a href="prime.php">
                        <i class="fas fa-square-root-alt"></i>
                        <span>Números Primos</span>
                    </a>
                </li>
            </ul>
        </nav>

        <main class="content">
            <div class="container">
                <h1>Multiplicación de Matrices</h1>
                
                <form method="GET" class="form-control">
                    <label for="size">Tamaño de las matrices (NxN):</label>
                    <input type="number" name="size" id="size" value="<?php echo isset($_GET['size']) ? $_GET['size'] : 100; ?>" min="1" max="500">
                    <button type="submit" class="btn">Calcular</button>
                </form>

                <div class="result">
                    <?php
                    if (isset($_GET['size'])) {
                        $size = $_GET['size'];
                        $start = microtime(true);
                        
                        // Crear matrices
                        $matrix1 = array();
                        $matrix2 = array();
                        $result = array();
                        
                        // Inicializar matrices
                        for ($i = 0; $i < $size; $i++) {
                            for ($j = 0; $j < $size; $j++) {
                                $matrix1[$i][$j] = rand(1, 10);
                                $matrix2[$i][$j] = rand(1, 10);
                                $result[$i][$j] = 0;
                            }
                        }
                        
                        // Multiplicar matrices
                        for ($i = 0; $i < $size; $i++) {
                            for ($j = 0; $j < $size; $j++) {
                                for ($k = 0; $k < $size; $k++) {
                                    $result[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
                                }
                            }
                        }
                        
                        $end = microtime(true);
                        $exectime = $end - $start;

                        echo "<div class='matrix-result'>";
                        echo "<h2>Resultados</h2>";
                        echo "<p class='matrix-size'>Tamaño de matriz: {$size}x{$size}</p>";
                        echo "<p class='exec-time'>Tiempo de ejecución: " . number_format($exectime, 6) . " segundos</p>";
                        echo "<p class='operations'>Operaciones realizadas: " . number_format($size * $size * $size) . "</p>";
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
        </main>
    </div>
</body>
</html> 