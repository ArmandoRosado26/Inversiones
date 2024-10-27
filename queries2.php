<?php
session_start(); // Inicia la sesión
include 'db.php'; // Asegúrate de que tu conexión a la base de datos esté configurada correctamente

$action = $_GET['action'] ?? null; // Obtiene la acción de la URL

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
            echo "Inversión registrada exitosamente."; // Respuesta de éxito
        } else {
            echo "Error al insertar la inversión: " . mysqli_error($conn); // Respuesta de error
        }
    } else {
        echo "Error al insertar el cuentahabiente: " . mysqli_error($conn); // Respuesta de error
    }

    mysqli_close($conn);
    exit(); // Termina la ejecución del script
}

$query = ""; // Inicializa la consulta

switch ($action) {
    case 'get_all_cuentahabientes':
        // Consulta para obtener todos los cuentahabientes y sus inversiones ordenados por monto de inversión
        $query = "
            SELECT 
                c.id_cuentahabiente,
                c.nombre,
                c.email,
                c.telefono,
                i.monto,
                i.plazo,
                -- Asumiendo una tasa de interés del 5%
                (i.monto * 0.05 * i.plazo / 365) AS interes_generado
            FROM 
                CUENTAHABIENTE c
            LEFT JOIN 
                INVERSION i ON c.id_cuentahabiente = i.id_cuentahabiente
            ORDER BY 
                i.monto DESC
        ";
        break;

    default:
        die("Acción no válida.");
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Mostrar los resultados en formato de tabla HTML
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_cuentahabiente'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefono'] . "</td>";
        echo "<td>" . ($row['monto'] ? $row['monto'] : 'Sin Inversión') . "</td>";
        echo "<td>" . ($row['plazo'] ? $row['plazo'] : 'Sin Inversión') . "</td>";
        echo "<td>" . ($row['interes_generado'] ? number_format($row['interes_generado'], 2) : 'Sin Inversión') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";
}

mysqli_close($conn);
?>
