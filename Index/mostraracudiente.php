<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado Estudiante</title>
  <style>
    :root {
      --azul: #0059FF;
      --blanco: #ffffff;
      --gris-claro: #f5f5f5;
      --texto: #333333;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background: linear-gradient(to right, #dfe9f3, #ffffff);
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .resultado-container {
      background-color: var(--blanco);
      padding: 2rem 3rem;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 900px;
      width: 100%;
      animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      color: var(--azul);
      margin-bottom: 1.5rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      background-color: var(--gris-claro);
      border-radius: 10px;
      overflow: hidden;
    }

    table th, table td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ccc;
    }

    table th {
      background-color: var(--azul);
      color: var(--blanco);
    }

    table tr:last-child td {
      border-bottom: none;
    }

    .mensaje {
      text-align: center;
      font-size: 1.1rem;
      color: var(--texto);
      margin-top: 1rem;
    }

    .btn-volver {
      margin-top: 2rem;
      display: inline-block;
      padding: 12px 24px;
      background-color: #e0e0e0;
      color: var(--azul);
      font-weight: bold;
      border: none;
      border-radius: 10px;
      text-decoration: none;
      font-size: 1rem;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-volver:hover {
      background-color: var(--azul);
      color: white;
    }

    img.foto-estudiante {
      width: 80px;
      height: auto;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="resultado-container">
    <?php
    require 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $identificacionacudiente = $_POST['identificacionacudiente'];

        $sql = "SELECT * FROM acudiente WHERE identificacionacudiente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $identificacionacudiente);

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            echo "<h1><b>Datos del Acudiente</b></h1>";
            echo "<table>
            <tr>
            <th>ID</th>
            <th>Identificación del Estudiante</th>
            <th>Identificación del Acudiente</th>
            <th>Nombre del Estudiante</th>
            <th>Nombre del Acudiente</th>
            <th>Grado del Estudiante</th>
            <th>Foto del Estudiante</th>
            </tr>";

            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["identificacionestudiante"] . "</td>
                <td>" . $row["identificacionacudiente"] . "</td>
                <td>" . $row["nombreestudiante"] . "</td>
                <td>" . $row["nombreacudiente"] . "</td>
                <td>" . $row["gradoestudiante"] . "</td>
                </tr>";
            }

            echo "</table>";
        } else {
            echo "<p class='mensaje'>No se encontró ningún acudiente con esa identificación.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <center>
    <a href="visionadmin.html" class="btn-volver">Volver</a>
    </center>
  </div>
</body>
</html>
