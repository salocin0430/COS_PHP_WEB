<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests de Rendimiento - Ordenamiento</title>
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
                <li>
                    <a href="matrix.php">
                        <i class="fas fa-table"></i>
                        <span>Multiplicación de Matrices</span>
                    </a>
                </li>
                <li class="active">
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
                <h1>Test de Ordenamiento</h1>
                
                <form method="GET" class="form-control">
                    <label for="size">Cantidad de números a ordenar:</label>
                    <input type="number" name="size" id="size" value="<?php echo isset($_GET['size']) ? $_GET['size'] : 10000; ?>" min="1000" max="100000">
                    <select name="algorithm" id="algorithm">
                        <option value="bubble" <?php echo (isset($_GET['algorithm']) && $_GET['algorithm'] == 'bubble') ? 'selected' : ''; ?>>Bubble Sort</option>
                        <option value="quick" <?php echo (isset($_GET['algorithm']) && $_GET['algorithm'] == 'quick') ? 'selected' : ''; ?>>Quick Sort</option>
                    </select>
                    <button type="submit" class="btn">Ordenar</button>
                </form>

                <div class="result">
                    <?php
                    if (isset($_GET['size']) && isset($_GET['algorithm'])) {
                        $size = $_GET['size'];
                        $algorithm = $_GET['algorithm'];
                        
                        // Generar array aleatorio
                        $numbers = array();
                        for ($i = 0; $i < $size; $i++) {
                            $numbers[] = rand(1, 10000);
                        }
                        
                        $start = microtime(true);
                        
                        if ($algorithm == 'bubble') {
                            // Bubble Sort
                            for ($i = 0; $i < $size - 1; $i++) {
                                for ($j = 0; $j < $size - $i - 1; $j++) {
                                    if ($numbers[$j] > $numbers[$j + 1]) {
                                        $temp = $numbers[$j];
                                        $numbers[$j] = $numbers[$j + 1];
                                        $numbers[$j + 1] = $temp;
                                    }
                                }
                            }
                        } else {
                            // Quick Sort
                            function quickSort(&$arr, $low, $high) {
                                if ($low < $high) {
                                    $pivot = $arr[$high];
                                    $i = $low - 1;
                                    
                                    for ($j = $low; $j < $high; $j++) {
                                        if ($arr[$j] <= $pivot) {
                                            $i++;
                                            $temp = $arr[$i];
                                            $arr[$i] = $arr[$j];
                                            $arr[$j] = $temp;
                                        }
                                    }
                                    
                                    $temp = $arr[$i + 1];
                                    $arr[$i + 1] = $arr[$high];
                                    $arr[$high] = $temp;
                                    
                                    $pi = $i + 1;
                                    
                                    quickSort($arr, $low, $pi - 1);
                                    quickSort($arr, $pi + 1, $high);
                                }
                            }
                            
                            quickSort($numbers, 0, $size - 1);
                        }
                        
                        $end = microtime(true);
                        $exectime = $end - $start;

                        echo "<div class='sort-result'>";
                        echo "<h2>Resultados</h2>";
                        echo "<p class='algorithm'>Algoritmo: " . ($algorithm == 'bubble' ? 'Bubble Sort' : 'Quick Sort') . "</p>";
                        echo "<p class='array-size'>Tamaño del array: " . number_format($size) . " elementos</p>";
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
        </main>
    </div>
</body>
</html> 