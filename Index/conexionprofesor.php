<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "informacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("conexion fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $identificacion = $_POST['identificacion']; 
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM profesor WHERE identificacion = ? AND contraseña = ?"; 


    $stmt = $conn->prepare($sql); 


    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error); 
    }

    
    $stmt->bind_param("is", $identificacion, $contraseña); 


    $stmt->execute();


    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
    
        header("Location: http://localhost/Index/visionprofe.html");
        exit();
    } else {
 
        echo '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Error de inicio de sesión</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f2f2f2;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    font-family: "Segoe UI", sans-serif;
                }
                .popup {
                    background-color: white;
                    padding: 2rem;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                    text-align: center;
                    animation: fadeIn 0.5s ease-in-out;
                }
                .popup h2 {
                    color: #e74c3c;
                    margin-bottom: 1rem;
                }
                .popup p {
                    color: #333;
                    margin-bottom: 2rem;
                }
                .popup a {
                    padding: 10px 20px;
                    background-color: #0059FF;
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    transition: background-color 0.3s ease;
                }
                .popup a:hover {
                    background-color: #0047d1;
                }
                @keyframes fadeIn {
                    from { opacity: 0; transform: scale(0.95); }
                    to { opacity: 1; transform: scale(1); }
                }
            </style>
        </head>
        <body>
            <div class="popup">
                <h2>Acceso Denegado</h2>
                <p>Nombre de usuario o contraseña incorrectos.</p>
                <a href="javascript:history.back()">Intentar de nuevo</a>
            </div>
        </body>
        </html>
        ';
    }

  
    $stmt->close();
}


$conn->close(); 
?>
