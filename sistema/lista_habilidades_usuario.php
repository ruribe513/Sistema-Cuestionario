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
		<h1>Lista de Habilidades</h1>
		<table>
			<tr>
				<!--<th>ID</th>-->
				<th>Habilidades</th>
			</tr>
			<?php
      if (empty($_GET['id'])) {
        header('Location: lista_usuarios.php');
        mysqli_close($conection);
      }
          $idUsuario = $_GET['id'];
					$query= mysqli_query($conection, "SELECT h.pertenece_a, h.tecnoHabi FROM habi_tecno h INNER JOIN users u ON u.idUsuario = $idUsuario WHERE h.pertenece_a = $idUsuario");
          mysqli_close($conection);
          $result = mysqli_num_rows($query);

					if ($result > 0) {
						while ($data = mysqli_fetch_array($query)) {
			?>
					<tr>
						<!--<td><?php echo $data["pertenece_a"]; ?></td>-->
						<td><?php echo $data["tecnoHabi"]; ?></td>
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
