<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";

  if (!empty($_POST)) {

    $idProyecto = $_POST['idProyecto'];

    $query_delete = mysqli_query($conection, "DELETE FROM proyectos WHERE idProyecto = $idProyecto");
    mysqli_close($conection);

    if ($query_delete) {
      header("location: lista_proyectos.php");
    }else {
      echo "Error al eliminar";
    }

  }


  if (empty($_REQUEST['id'])) {
    header("location: lista_proyectos.php");
    mysqli_close($conection);
  }else {
    $idProyecto = $_REQUEST['id'];

    $query =mysqli_query($conection, "SELECT p.nombrePro FROM proyectos p WHERE p.idProyecto = $idProyecto");

    mysqli_close($conection);
    $result = mysqli_num_rows($query);

    if ($result > 0) {
      while ($data = mysqli_fetch_array($query)) {
        $nombre = $data['nombrePro'];
      }
    }else {
      header("location: lista_proyectos.php");
    }
  }


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Eliminar Proyecto</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
		<div class="data_delete">
      <h2>¿Esta seguro de eliminar el proyecto?</h2>
      <p>Nombre: <span><?php echo $nombre; ?></span> </p>

      <form method="post" action="">
        <input type="hidden" name="idProyecto" value="<?php echo $idProyecto; ?>">
        <a href="lista_proyectos.php" class="btn_cancel">Cancelar</a>
        <input type="submit" value="Aceptar" class="btn_ok">
      </form>

    </div>

	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
