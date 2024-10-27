<?php
session_start();
include 'db.php';

$action = $_GET['action'] ?? null;


$query = "";

switch ($action) {
    case 'get_all_cuentahabientes':
        
        $query = "
            SELECT 
                c.id_cuentahabiente,
                c.nombre,
                c.email,
                c.telefono,
                i.monto,
                i.plazo,
                i.interes_ganado AS interes_generado -- Usa el valor almacenado en la columna interes_ganado
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
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_cuentahabiente'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefono'] . "</td>";
        echo "<td>" . ($row['monto'] ? "$" . number_format($row['monto'], 2) : 'Sin Inversión') . "</td>";
        echo "<td>" . ($row['plazo'] ? $row['plazo'] : 'Sin Inversión') . "</td>";
        echo "<td>" . ($row['interes_generado'] ? "$" . number_format($row['interes_generado'], 2) : 'Sin Inversión') . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";
}


