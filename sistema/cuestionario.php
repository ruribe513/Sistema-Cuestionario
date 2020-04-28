<?php
session_start();
include "../database.php";

$iduser = $_SESSION['idUser'];
$idProyecto = $_GET["proyectoid"];



$query = mysqli_query($conection, "SELECT c.idCuestionario, c.idProyec FROM cuestionario c WHERE idProyec = $idProyecto");
while ($data = mysqli_fetch_array($query)) {
  $idCuestio = $data['idCuestionario'];
  $idProyec = $data['idProyec'];
}

$sql_update = mysqli_query($conection, "UPDATE cuestionario_diligenciado SET estado = 'S' WHERE id_Usuario = $iduser");

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Sistema</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
    <form action="" method="post">
      <table>
        <tr>
          <!--<th>ID</th>-->
          <th>Preguntas</th>
          <th>Opciones</th>
        </tr>
          <?php
          $query2 = mysqli_query($conection, "SELECT cp.idCuesPreg, cp.id_Cuestionario, cp.pregunta FROM cuestionario_preguntas cp WHERE cp.id_Cuestionario = $idCuestio");
          //$result = mysqli_num_rows($query2);
            while ($data = mysqli_fetch_array($query2)) {
            ?>
            <tr>
              <!--<td><?php echo $data["idCuesPreg"]; ?></td>-->
              <td><?php echo $data["pregunta"]; ?></td>

              <td>
                <a href="respuesta.php?id=<?php echo $data["idCuesPreg"]; ?>" class="link_edit">Responder</a>
              </td>
          <?php
          }
        ?>

      </table>
      <a href="logout.php" class="btn_finish">Finalizar</a>
    </form>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
