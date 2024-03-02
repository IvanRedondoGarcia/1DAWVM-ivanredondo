<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor MySQL no está en localhost
$username = "root"; // Cambia esto al nombre de usuario de tu base de datos
$password = ""; // Cambia esto a la contraseña de tu base de datos
$dbname = "finalivanredondo";

// Crear conexión
$conn = new mysqli("localhost", "root", "", "finalivanredondo");

// Verificar conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recuperar datos del formulario
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];

  // Preparar la consulta SQL
  $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena')";

  // Ejecutar la consulta
  if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. ¡Bienvenido, $usuario!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="finalcssivanredondo.css">
  <title>Registro</title>
</head>
<body>

<h2>Registro de Usuario</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="usuario">Usuario:</label><br>
  <input type="text" id="usuario" name="usuario" required><br>
  <label for="contrasena">Contraseña:</label><br>
  <input type="password" id="contrasena" name="contrasena" required><br><br>
  <input type="submit" value="Registrarse">
</form>

</body>
</html>
