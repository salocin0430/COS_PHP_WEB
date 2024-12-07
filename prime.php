<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests de Rendimiento - Números Primos</title>
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
                <li>
                    <a href="sort.php">
                        <i class="fas fa-sort"></i>
                        <span>Ordenamiento</span>
                    </a>
                </li>
                <li class="active">
                    <a href="prime.php">
                        <i class="fas fa-square-root-alt"></i>
                        <span>Números Primos</span>
                    </a>
                </li>
            </ul>
        </nav>

        <main class="content">
            <div class="container">
                <h1>Cálculo de Números Primos</h1>
                
                <form method="GET" class="form-control">
                    <label for="limit">Encontrar primos hasta:</label>
                    <input type="number" name="limit" id="limit" value="<?php echo isset($_GET['limit']) ? $_GET['limit'] : 10000; ?>" min="1" max="1000000">
                    <button type="submit" class="btn">Calcular</button>
                </form>

                <div class="result">
                    <?php
                    if (isset($_GET['limit'])) {
                        $limit = $_GET['limit'];
                        $start = microtime(true);
                        
                        // Criba de Eratóstenes
                        $primes = array_fill(0, $limit + 1, true);
                        $primes[0] = $primes[1] = false;
                        
                        for ($i = 2; $i * $i <= $limit; $i++) {
                            if ($primes[$i]) {
                                for ($j = $i * $i; $j <= $limit; $j += $i) {
                                    $primes[$j] = false;
                                }
                            }
                        }
                        
                        // Contar primos encontrados
                        $count = 0;
                        $lastPrimes = [];
                        for ($i = 2; $i <= $limit; $i++) {
                            if ($primes[$i]) {
                                $count++;
                                if ($count > $limit - 5) {
                                    $lastPrimes[] = $i;
                                }
                            }
                        }
                        
                        $end = microtime(true);
                        $exectime = $end - $start;

                        echo "<div class='prime-result'>";
                        echo "<h2>Resultados</h2>";
                        echo "<p class='prime-count'>Números primos encontrados: " . number_format($count) . "</p>";
                        echo "<p class='last-primes'>Últimos primos encontrados: " . implode(", ", $lastPrimes) . "</p>";
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