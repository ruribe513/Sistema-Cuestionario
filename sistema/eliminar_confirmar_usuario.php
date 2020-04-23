<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";

  if (!empty($_POST)) {
    if ($_POST['idUsuario'] == 1) {
      header("location: lista_usuarios.php");
      mysqli_close($conection);
      exit;
    }
    $idUsuario = $_POST['idUsuario'];

    //$query_delete = mysqli_query($conection, "DELETE FROM users WHERE idUsuario = $idUsuario");
    $query_delete = mysqli_query($conection, "UPDATE users SET estatus = 0 WHERE idUsuario = $idUsuario ");
    mysqli_close($conection);

    if ($query_delete) {
      header("location: lista_usuarios.php");
    }else {
      echo "Error al eliminar";
    }

  }


  if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
    header("location: lista_usuarios.php");
    mysqli_close($conection);
  }else {
    $idUsuario = $_REQUEST['id'];

    $query =mysqli_query($conection, "SELECT u.user, r.rol FROM users u INNER JOIN roles r ON u.rol_id = r.idRol WHERE u.idUsuario = $idUsuario");

    mysqli_close($conection);
    $result = mysqli_num_rows($query);

    if ($result > 0) {
      while ($data = mysqli_fetch_array($query)) {
        $nombre = $data['user'];
        $rol = $data['rol'];
      }
    }else {
      header("location: lista_usuarios.php");
    }
  }


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
		<div class="data_delete">
      <h2>¿Esta seguro de eliminar el registro?</h2>
      <p>Nombre: <span><?php echo $nombre; ?></span> </p>
      <p>Tipo de Usuario: <span><?php echo $rol; ?></span> </p>

      <form method="post" action="">
        <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
        <a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
        <input type="submit" value="Aceptar" class="btn_ok">
      </form>

    </div>

	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
