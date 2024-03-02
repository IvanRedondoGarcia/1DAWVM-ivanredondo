<?php
// Conexión a la base de datos


$conn = new mysqli("localhost", "root", "", "finalivanredondo");

  session_start();

 

  if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
    $records = $conn->prepare('SELECT usuario, contrasena FROM usuarios 
                              WHERE usuario = "'.$_POST["usuario"].'"');
    $records->execute();
    $results = $records->get_result()->fetch_assoc();

    $message = '';

    if ($results && isset($results["contrasena"])) {
      $_SESSION['usuario'] = $results['usuario'];
      header("Location: cancionesivanredondo.php");
    } else {
      $message = 'Las credenciales no corresponden a ningún usuario';
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="finalcssivanredondo.css">
    <title>Iniciar Sesion</title>
</head>
<body>
    <h2>Iniciar Sesion</h2>
    <form action="loginivanredondo.php" method="post">
        Usuario:<br>
        <input type="text" name="usuario" required><br>
        Contraseña:<br>
        <input type="password" name="contrasena" required><br><br>
        <input type="submit" value="Iniciar Sesion">
    </form>
    <a href="creacionivanredondo.php">Creacion, actualizacion, modificacion o borrado de usuarios</a>
</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
