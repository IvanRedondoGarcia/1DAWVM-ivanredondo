<?php
// Conexión a la base de datos



$conn = new mysqli("localhost", "root", "", "finalivanredondo");
$query = "SELECT * FROM canciones";

// Verificar conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Función para crear una nueva canción
function crearCancion($codca, $nombre, $autor) {
  global $conn;
  $sql = "INSERT INTO canciones (codca, nombre, autor) VALUES ('$codca', '$nombre', '$autor')";
  if ($conn->query($sql) === TRUE) {
    return "Nueva canción creada correctamente.";
  } else {
    return "Error al crear canción: " . $conn->error;
  }
}

// Función para actualizar los datos de una canción
function actualizarCancion($codca, $nombre, $autor) {
  global $conn;
  $sql = "UPDATE canciones SET nombre='$nombre', autor='$autor' WHERE codca='$codca'";
  if ($conn->query($sql) === TRUE) {
    return "Datos de la canción actualizados correctamente.";
  } else {
    return "Error al actualizar datos de la canción: " . $conn->error;
  }
}

// Función para eliminar una canción
function eliminarCancion($codca) {
  global $conn;
  $sql = "DELETE FROM canciones WHERE codca='$codca'";
  if ($conn->query($sql) === TRUE) {
    return "Canción eliminada correctamente.";
  } else {
    return "Error al eliminar canción: " . $conn->error;
  }
}

// Verificar si se ha enviado el formulario para crear una canción
if (isset($_POST["crear_cancion"])) {
  $codca = $_POST["codca"];
  $nombre = $_POST["nombre"];
  $autor = $_POST["autor"];
  $mensaje = crearCancion($codca, $nombre, $autor);
}

// Verificar si se ha enviado el formulario para actualizar una canción
if (isset($_POST["actualizar_cancion"])) {
  $codca = $_POST["codca"];
  $nombre = $_POST["nombre"];
  $autor = $_POST["autor"];
  $mensaje = actualizarCancion($codca, $nombre, $autor);
}

// Verificar si se ha enviado el formulario para eliminar una canción
if (isset($_POST["eliminar_cancion"])) {
  $codca = $_POST["codca"];
  $mensaje = eliminarCancion($codca);
}

// Cerrar conexión
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="finalcssivanredondo2.css">
  <title>Administrar Canciones</title>
</head>
<body>

<h2>Crear Nueva Canción</h2>
<form method="post">
  <input type="text" name="codca" placeholder="Código de Canción" required><br>
  <input type="text" name="nombre" placeholder="Nombre de Canción" required><br>
  <input type="text" name="autor" placeholder="Autor de Canción" required><br>
  <input type="submit" name="crear_cancion" value="Crear Canción">
</form>

<h2>Actualizar Datos de Canción</h2>
<form method="post">
  <input type="text" name="codca" placeholder="Código de Canción a Actualizar" required><br>
  <input type="text" name="nombre" placeholder="Nuevo Nombre de Canción" required><br>
  <input type="text" name="autor" placeholder="Nuevo Autor de Canción" required><br>
  <input type="submit" name="actualizar_cancion" value="Actualizar Canción">
</form>

<h2>Eliminar Canción</h2>
<form method="post">
  <input type="text" name="codca" placeholder="Código de Canción a Eliminar" required><br>
  <input type="submit" name="eliminar_cancion" value="Eliminar Canción">
</form>

<?php
// Mostrar mensajes de operaciones
if (isset($mensaje)) {
  echo "<p>$mensaje</p>";
}


?>
<table>
			<thead>
				<tr>
					<th>codca</th>
					<th>nombre</th>
					<th>autor</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				//Ejecuto la query para obtener los resultados de la cadena de consulta en la variable $query
				if($result = mysqli_query($conn, $query)):  
			?>
				<?php 
					//la variable $user contiene el contenido de $result en un array asociativo
					while($canciones = mysqli_fetch_assoc($result)): 
				?>
					<tr>
						<td width="10%" class="text-center"><?php echo $canciones['codca']; ?></td>
						<td width="10%" class="text-center"><?php echo $canciones['nombre']; ?></td>
						<td width="10%" class="text-center"><?php echo $canciones['autor']; ?></td>
					</tr>
				<?php endwhile; ?>
				<?php mysqli_free_result($result); ?>
			<?php endif; ?>
			</tbody>		
		</table>
<?php
    $conn->close();
?>
    <a href="destruccion.php" class="destruir">Cerrar sesion</a>
</body>
</html>
