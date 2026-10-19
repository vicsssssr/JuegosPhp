<?php
// Sumativa 1, Victoria Pinto, 31817300, Programación III
// 1. Iniciamos la sesión para poder recordar datos entre recargas
session_start();

$mensaje = "";

// 2. Si el usuario hace clic en "Reiniciar" o si el juego apenas comienza
if (!isset($_SESSION['numero_secreto']) || isset($_POST['reiniciar'])) {
    // Generamos un número aleatorio del 1 al 50
    $_SESSION['numero_secreto'] = rand(1, 50);
    $_SESSION['intentos'] = 0;
}

// 3. Si el usuario envió un número a través del formulario
if (isset($_POST['adivinanza'])) {
    $intento = (int) $_POST['adivinanza']; // Convertimos la entrada a un número entero (integer)
    $_SESSION['intentos']++; // Sumamos un intento

    // Evaluamos el número usando condicionales
    if ($intento < $_SESSION['numero_secreto']) {
        $mensaje = "El número es **mayor** que $intento. (Llevas {$_SESSION['intentos']} intentos)";
    } elseif ($intento > $_SESSION['numero_secreto']) {
        $mensaje = "El número es **menor** que $intento. (Llevas {$_SESSION['intentos']} intentos)";
    } else {
        $mensaje = "🎉 ¡Felicidades! Era el {$_SESSION['numero_secreto']}. Lo lograste en {$_SESSION['intentos']} intentos.";
        // Eliminamos el número para forzar un reinicio en la próxima jugada
        unset($_SESSION['numero_secreto']); 
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego: Adivina el Número</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .tablero { background: #3e1665; padding: 20px; border-radius: 10px; display: inline-block; }
        input[type="number"] { padding: 10px; font-size: 16px; width: 100px; }
        button { padding: 10px 15px; font-size: 16px; cursor: pointer; border-radius: 16px; }
        button:hover { background-color: #b055ff; }
    </style>
</head>
<body>

    <div class="tablero">
        <h1>Adivina el Número 🎯</h1>
        <h3 style="color: white;">¡He pensado en un número del 1 al 50! ¿Puedes adivinarlo?</h3>
        
        <!-- Mostramos el mensaje del sistema -->
        <p><?php echo $mensaje; ?></p>

        <!-- Formulario que se envía a esta misma página usando el método POST -->
        <form method="POST" action="juego.php">
            <?php if(isset($_SESSION['numero_secreto'])): ?>
                <input type="number" name="adivinanza" min="1" max="50" required autofocus>
                <button type="submit">Adivinar</button>
            <?php else: ?>
                <!-- Si ya ganó, mostramos el botón de jugar de nuevo -->
                <button type="submit" name="reiniciar">Jugar de nuevo</button>
            <?php endif; ?>
        </form>
        
        <?php if(isset($_SESSION['numero_secreto'])): ?>
            <br>
            <!-- Botón opcional para reiniciar en cualquier momento -->
            <form method="POST" action="juego.php">
                <button type="submit" class="reiniciar" style="background: #5d2d88; 
                color: white; border: none;">Rendirse / Reiniciar</button>
              </form>
        <?php endif; ?>

        <!-- Botón para volver al menú usando el truco de inline-block -->
        <a href="index.php" class="btn-volver" style="margin: 12px;">Volver al menú</a>
    </div>

</body>
</html>