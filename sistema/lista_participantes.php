<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Lista de Habilidades</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
		<h1>Lista de Participantes</h1>
		<table>
			<tr>
				<!--<th>ID</th>-->
				<th>Participantes</th>
			</tr>
			<?php
      if (empty($_GET['id'])) {
        header('Location: lista_usuarios.php');
        mysqli_close($conection);
      }
          $idUsuario = $_GET['id'];
					$query= mysqli_query($conection, "SELECT u.proyecto_id, u.user FROM users u INNER JOIN proyectos p ON p.idProyecto = $idUsuario WHERE u.proyecto_id = $idUsuario");
          mysqli_close($conection);
          $result = mysqli_num_rows($query);

					if ($result > 0) {
						while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<!--<td><?php echo $data["proyecto_id"]; ?></td>-->
						<td><?php echo $data["user"]; ?></td>
					</tr>
          <?php
        }
      }

           ?>
		</table>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
