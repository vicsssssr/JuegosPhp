<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Sumativa 1, Victoria Pinto, 31817300, Programación III -->
    <style>
        .caja-formulario {
            background-color: #220b39;
            padding: 30px;
            border-radius: 15px;
            max-width: 400px;
            margin: 0 auto; /* Lo centra */
            text-align: left; 
        }
        /* Estilo para las cajas donde uno escribe */
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 2px solid #2e104c; /* Borde morado */
            border-radius: 5px;
            box-sizing: border-box;
        }
        /* Estilo para el botón de enviar */
        button {
            background-color: #5d2d88;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #9d4be5; /*  más claro al pasar el mouse */
        }

        label{
            color: #e6c9ff;
        }
    </style>
</head>
<body>

    <?php
     // Esta variable guarda el mensaje de éxito o error para mostrarlo en pantalla
        $mensaje_resultado = "";

     // Verificamos si el usuario presionó el botón de enviar
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
     // Recogemos los datos que el usuario envió
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $mensaje = $_POST["mensaje"];

     // Creamos la función para validar el formato del correo
        function validar_correo($email) {
        // filter_var es una herramienta de PHP que revisa si el formato del correo es real
        return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

     // Usamos la función para comprobar el correo que ingresaron
        if (validar_correo($correo)) {
        
            $destinatario = "profesor@universidad.com"; 
            $asunto = "Nuevo mensaje de: " . $nombre;
            $cuerpo = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";

        // Intentamos enviar el correo con la función mail()
        @mail($destinatario, $asunto, $cuerpo);

        // Mostramos el resultado positivo en pantalla
        $mensaje_resultado = "<p style='color: green; font-weight: bold;'>¡Éxito! El correo tiene un formato válido y los datos fueron procesados.</p>";
    } else {
        // Mostramos un error si escribieron mal el correo
        $mensaje_resultado = "<p style='color: red; font-weight: bold;'>
        Error: El formato del correo electrónico no es válido. Falta el '@' y el '.com'.</p>";
    }
}
?>

    <div class="caja-formulario">
        <h2 style="text-align: center; color: white;">Contacto Simple</h2>

        <!-- Aquí es donde PHP imprimirá el mensaje verde o rojo -->
        <?php echo $mensaje_resultado; ?>

        <!-- El formulario  en HTML -->
        <form method="POST" action="">
            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo electrónico:</label>
            <input type="text" id="correo" name="correo" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <button type="submit">Enviar Mensaje</button>
        </form>
        
        <br>
        <!-- Botón para volver al menú usando el truco de inline-block -->
        <a href="index.php" class="btn-volver" style="margin-left: 74px;">Volver al menú</a>
    </div>

</body>
</html>