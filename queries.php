<?php
include 'db.php';

$action = $_GET['action'];

switch ($action) {
    case 'min_investment':
        // Mostrar id_cuentahabiente y nombre de los usuarios que han invertido el mínimo
        $query = "
            SELECT CUENTAHABIENTE.id_cuentahabiente, CUENTAHABIENTE.nombre 
            FROM INVERSION 
            JOIN CUENTAHABIENTE ON INVERSION.id_cuentahabiente = CUENTAHABIENTE.id_cuentahabiente 
            WHERE INVERSION.monto = 5000";
        break;

    case 'max_term':
        // Mostrar id_cuentahabiente y nombre de los usuarios con el mayor plazo de inversión
        $query = "
            SELECT CUENTAHABIENTE.id_cuentahabiente, CUENTAHABIENTE.nombre 
            FROM INVERSION 
            JOIN CUENTAHABIENTE ON INVERSION.id_cuentahabiente = CUENTAHABIENTE.id_cuentahabiente 
            WHERE INVERSION.plazo = 365";
        break;

    case 'first_interest':
        // Mostrar el interés ganado del primer cuentahabiente en la tabla
        $query = "
            SELECT CUENTAHABIENTE.id_cuentahabiente, CUENTAHABIENTE.nombre, INVERSION.interes_ganado 
            FROM INVERSION 
            JOIN CUENTAHABIENTE ON INVERSION.id_cuentahabiente = CUENTAHABIENTE.id_cuentahabiente 
            ORDER BY CUENTAHABIENTE.id_cuentahabiente 
            LIMIT 1";
        break;
        case 'get_all_cuentahabientes':
            // Consulta para obtener todos los cuentahabientes
            $query3 = "SELECT id_cuentahabiente, nombre, email, telefono FROM CUENTAHABIENTE";
            break;

    default:
        die("Acción no válida.");
}




$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    // Mostrar los encabezados de la tabla
    echo "<tr>";
    echo "<th>ID Cuentahabiente</th><th>Nombre</th>";
    if ($action == 'first_interest') {
        echo "<th>Interés Ganado</th>";
    }
    echo "</tr>";

    // Mostrar los resultados
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_cuentahabiente'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        if (isset($row['interes_ganado'])) {
            echo "<td>" . $row['interes_ganado'] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}



?>
