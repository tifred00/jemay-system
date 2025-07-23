<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado Actualización</title>
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
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .resultado-container {
      background-color: var(--blanco);
      padding: 2rem 3rem;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 700px;
      width: 100%;
      animation: fadeInUp 0.8s ease-out;
      text-align: center;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h1 {
      color: var(--azul);
      margin-bottom: 1.5rem;
    }

    .mensaje {
      font-size: 1.1rem;
      color: var(--texto);
      margin-top: 1rem;
    }

    .btn-volver {
      display: inline-block;
      margin-top: 2rem;
      padding: 12px 24px;
      background-color: #e0e0e0;
      color: var(--azul);
      font-weight: bold;
      border: none;
      border-radius: 10px;
      text-decoration: none;
      text-align: center;
      font-size: 1rem;
      transition: background-color 0.3s ease, color 0.3s ease;
      cursor: pointer;
    }

    .btn-volver:hover {
      background-color: var(--azul);
      color: white;
    }
  </style>
</head>
<body>
  <div class="resultado-container">
    <?php

    $conexion = new mysqli("localhost", "root", "", "informacion");

  
    if ($conexion->connect_error) {
        die("<p class='mensaje'>Error de conexión: " . $conexion->connect_error . "</p>");
    }

    $identificacion = $_POST['identificacion'];
    $contraseña = $_POST['contraseña'];

    $sql = "UPDATE profesor SET contraseña = '$contraseña' WHERE identificacion = '$identificacion'";

    if ($conexion->query($sql) === TRUE) {
        echo "<h1>Resultado</h1>";
        echo "<p class='mensaje'>Contraseña actualizada correctamente.</p>";
    } else {
        echo "<h1>Error</h1>";
        echo "<p class='mensaje'>Error al actualizar: " . $conexion->error . "</p>";
    }

   
    $conexion->close();
    ?>

    <a href="visionadmin.html" class="btn-volver">Volver</a>
  </div>
</body>
</html>
