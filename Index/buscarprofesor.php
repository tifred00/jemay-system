<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "informacion";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST['identificacion'];


    $sql = "SELECT * FROM profesor WHERE identificacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", identificacion);  
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
 
        while ($row = $result->fetch_assoc()) {
            echo "<h3>Datos del paciente:</h3>";
            echo "<p><b>Identificación:</b> " . $row["identificacion"] . "</p>";
            echo "<p><b>Contraseña:</b> " . $row["contraseña"] . "</p>";
        }
    } else {

        echo "No se encontró ningún paciente con esa identificación.";
    }


    $stmt->close();
    $conn->close();
}
?>