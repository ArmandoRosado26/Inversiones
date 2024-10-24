<?php
session_start(); // Inicia la sesión
include 'db.php';

// Verifica si hay un mensaje de éxito almacenado
if (isset($_SESSION['mensaje'])) {
    echo '<div style="color: green; text-align: center;">' . $_SESSION['mensaje'] . '</div>'; // Muestra el mensaje
    unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $monto = $_POST['monto'];
    $plazo = $_POST['plazo'];

    // Calcular el interés
    $interes_ganado = ($monto * 0.06) * ($plazo / 365);

    // Inserción en la tabla CUENTAHABIENTE
    $query1 = "INSERT INTO CUENTAHABIENTE (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

    if (mysqli_query($conn, $query1)) {
        // Obtener el id_cuentahabiente generado automáticamente
        $id_cuentahabiente = mysqli_insert_id($conn);

        // Inserción en la tabla INVERSION utilizando el id_cuentahabiente recién creado
        $query2 = "INSERT INTO INVERSION (id_cuentahabiente, monto, plazo, interes_ganado) 
                   VALUES ('$id_cuentahabiente', '$monto', '$plazo', '$interes_ganado')";

        if (mysqli_query($conn, $query2)) {
            $_SESSION['mensaje'] = "Inversión registrada exitosamente."; // Almacena el mensaje en la sesión
        } else {
            $_SESSION['mensaje'] = "Error al insertar la inversión: " . mysqli_error($conn); // Almacena el mensaje de error
        }
    } else {
        $_SESSION['mensaje'] = "Error al insertar el cuentahabiente: " . mysqli_error($conn); // Almacena el mensaje de error
    }

    // Cerrar conexión
    mysqli_close($conn);

    // Redirigir a la misma página para refrescar el mensaje
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
