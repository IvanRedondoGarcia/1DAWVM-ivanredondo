<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor MySQL no está en localhost
$username = "root"; // Cambia esto al nombre de usuario de tu base de datos
$password = ""; // Cambia esto a la contraseña de tu base de datos
$dbname = "finalivanredondo";

// Crear conexión
$conn = new mysqli("localhost", "root", "", "finalivanredondo");
$query = "SELECT * FROM usuarios";

// Verificar conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Función para crear un nuevo usuario
function crearUsuario($usuario, $contrasena) {
  global $conn;
  $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena')";
  if ($conn->query($sql) === TRUE) {
    return "Nuevo usuario creado correctamente.";
  } else {
    return "Error al crear usuario: " . $conn->error;
  }
}

// Función para actualizar la contraseña de un usuario
function actualizarContrasena($usuario, $contrasena) {
  global $conn;
  $sql = "UPDATE usuarios SET contrasena='$contrasena' WHERE usuario='$usuario'";
  if ($conn->query($sql) === TRUE) {
    return "Contraseña actualizada correctamente.";
  } else {
    return "Error al actualizar contraseña: " . $conn->error;
  }
}

// Función para eliminar un usuario
function eliminarUsuario($usuario) {
  global $conn;
  $sql = "DELETE FROM usuarios WHERE usuario='$usuario'";
  if ($conn->query($sql) === TRUE) {
    return "Usuario eliminado correctamente.";
  } else {
    return "Error al eliminar usuario: " . $conn->error;
  }
}

// Verificar si se ha enviado el formulario para crear un usuario
if (isset($_POST["crear_usuario"])) {
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];
  $mensaje = crearUsuario($usuario, $contrasena);
}

// Verificar si se ha enviado el formulario para actualizar la contraseña
if (isset($_POST["actualizar_contrasena"])) {
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["nueva_contrasena"];
  $mensaje = actualizarContrasena($usuario, $contrasena);
}

// Verificar si se ha enviado el formulario para eliminar un usuario
if (isset($_POST["eliminar_usuario"])) {
  $usuario = $_POST["usuario"];
  $mensaje = eliminarUsuario($usuario);
}


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="finalcssivanredondo3.css">
  <title>Administrar Usuarios</title>
</head>
<body>

<h2>Crear Nuevo Usuario</h2>
<form method="post">
  <input type="text" name="usuario" placeholder="Usuario" required><br>
  <input type="password" name="contrasena" placeholder="Contraseña" required><br>
  <input type="submit" name="crear_usuario" value="Crear Usuario">
</form>

<h2>Actualizar Contraseña</h2>
<form method="post">
  <input type="text" name="usuario" placeholder="Usuario" required><br>
  <input type="password" name="nueva_contrasena" placeholder="Nueva Contraseña" required><br>
  <input type="submit" name="actualizar_contrasena" value="Actualizar Contraseña">
</form>

<h2>Eliminar Usuario</h2>
<form method="post">
  <input type="text" name="usuario" placeholder="Usuario" required><br>
  <input type="submit" name="eliminar_usuario" value="Eliminar Usuario">
</form>
<a href="loginivanredondo.php">Volver al login</a>

<?php
// Mostrar mensajes de operaciones
if (isset($mensaje)) {
  echo "<p>$mensaje</p>";
}
?>
<table>
			<thead>
				<tr>
					<th>usuario</th>
					<th>contrasena</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//Ejecuto la query para obtener los resultados de la cadena de consulta en la variable $query
				if($result = mysqli_query($conn, $query)):  
			?>
				<?php 
					//la variable $user contiene el contenido de $result en un array asociativo
					while($usuarios = mysqli_fetch_assoc($result)): 
				?>
					<tr>
						<td width="10%" class="text-center"><?php echo $usuarios['usuario']; ?></td>
						<td width="10%" class="text-center"><?php echo $usuarios['contrasena']; ?></td>
					</tr>
				<?php endwhile; ?>
				<?php mysqli_free_result($result); ?>
			<?php endif; ?>
			</tbody>		
		</table>
    <?php
    $conn->close();
?>
</body>
</html>
