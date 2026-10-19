<?php
// Sumativa 1, Victoria Pinto, 31817300, Programación III
// Variable para almacenar el mensaje final
$resultado = "";

// Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $figura = $_POST["figura"] ?? "";
    $medida1 = (float) ($_POST["medida1"] ?? 0);
    $medida2 = (float) ($_POST["medida2"] ?? 0); // Puede venir vacía si es un círculo o cuadrado

    // Usamos switch para ejecutar un código diferente según la figura
    switch ($figura) {
        case "cuadrado":
            $area = $medida1 * $medida1;
            $resultado = "🟦 El área del cuadrado de lado $medida1 es: **$area**";
            break;

        case "triangulo":
            $area = ($medida1 * $medida2) / 2;
            $resultado = "🔺 El área del triángulo (base $medida1, altura $medida2) es: **$area**";
            break;

        case "circulo":
            // Usamos las funciones matemáticas nativas de PHP: pi() y pow() (potencia)
            $area = pi() * pow($medida1, 2);
            // round() redondea el resultado a 2 decimales
            $resultado = "🟣 El área del círculo de radio $medida1 es: **" . round($area, 2) . "**";
            break;

        default:
            $resultado = "⚠️ Por favor selecciona una figura válida.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de Figuras</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; color: white; background-color: #2c003e; }
        .tablero { background: #1a0024; padding: 30px; border-radius: 15px; display: inline-block; box-shadow: 0px 0px 15px rgba(0,0,0,0.5); }
        select, input { padding: 10px; margin: 10px 0; width: 80%; border-radius: 5px; border: none; font-size: 16px; }
        button { padding: 10px 20px; font-size: 16px; cursor: pointer; background-color: #8454ae; color: white; border: none; border-radius: 5px; }
        button:hover { background-color: #6a3a92; }
        .btn-volver { background-color: #444; display: inline-block; margin-top: 20px; padding: 10px 20px; border-radius: 5px; color: white; text-decoration: none; }
        .btn-volver:hover { background-color: #666; }
        .mensaje { background: #3d0a5e; padding: 15px; border-radius: 8px; font-size: 18px; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="tablero">
        <h1>Áreas de Figuras 📐</h1>
        
        <?php if ($resultado != ""): ?>
            <div class="mensaje"><?php echo $resultado; ?></div>
        <?php endif; ?>

        <form method="POST" action="figuras.php">
            <label for="figura">Selecciona una figura:</label><br>
            <select name="figura" id="figura" required>
                <option value="" disabled selected>Elige una opción...</option>
                <option value="cuadrado">Cuadrado</option>
                <option value="triangulo">Triángulo</option>
                <option value="circulo">Círculo</option>
            </select><br>

            <label>Medida 1 (Lado / Base / Radio):</label><br>
            <input type="number" step="0.01" name="medida1" required placeholder="Ej: 5.5"><br>

            <label>Medida 2 (Solo Altura para Triángulo):</label><br>
            <input type="number" step="0.01" name="medida2" placeholder="Ej: 10 (Opcional)"><br>

            <button type="submit">Calcular Área</button>
        </form>

        <!-- Botón para volver al menú usando el truco de inline-block -->
        <a href="index.php" class="btn-volver">Volver al menú</a>
    </div>

</body>
</html>