<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";
if (!empty($_POST)) {
  $alert='';
  if(empty($_POST['nombrePro']) || empty($_POST['numero_personas']) || empty($_POST['duracion']) || empty($_POST['dificultad']) || empty($_POST['metodologia']))
  {
    $alert='<p class="msg_error">Todos los campos son Obligatorios</p>';
  }else {

    $idProyecto = $_POST['idProyecto'];
    $nombre = $_POST['nombrePro'];
    $numeroPersonas  = $_POST['numero_personas'];
    $duracion  = $_POST['duracion'];
    $dificultad = $_POST['dificultad'];
    $metodologia = $_POST['metodologia'];


    $query = mysqli_query($conection,"SELECT * FROM proyectos WHERE (nombrePro = '$nombre' AND idProyecto != $idProyecto)");

    $result = mysqli_fetch_array($query);

    if ($result > 0) {
      $alert='<p class="msg_error">El proyecto ya existe</p>';
    }else {
      $sql_update = mysqli_query($conection, "UPDATE proyectos SET nombrePro = '$nombre', numero_personas = '$numeroPersonas',  duracion = '$duracion', dificultad = '$dificultad', metodologia = '$metodologia' WHERE idProyecto = $idProyecto");

      if ($sql_update) {
        $alert='<p class="msg_save">Proyecto actualizado correctamente</p>';
      }else {
        $alert='<p class="msg_error">Error al actualizar el proyecto</p>';
      }
    }
  }
  mysqli_close($conection);
}

//Mostrar Datos
if (empty($_GET['id'])) {
  header('Location: lista_proyectos.php');
}
$idproyect = $_GET['id'];
$sql = mysqli_query($conection, "SELECT p.idProyecto, p.nombrePro, p.numero_personas, p.duracion, p.dificultad, p.metodologia FROM proyectos p WHERE idProyecto = $idproyect");
mysqli_close($conection);
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
  header('Location: lista_proyectos.php');
}else {
  $option = '';
  while ($data = mysqli_fetch_array($sql)) {
    $idproyect = $data['idProyecto'];
    $nombre = $data['nombrePro'];
    $numeroPersonas  = $data['numero_personas'];
    $duracion  = $data['duracion'];
    $dificultad = $data['dificultad'];
    $metodologia = $data['metodologia'];


  }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Actualizar Proyecto</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
    <div class="form_register">
      <h1>Actualizar Proyecto</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
      <form action="" method="post">
        <input type="hidden" name="idProyecto" value="<?php echo $idproyect ?>">
        <label for="nombrePro">Titulo Proyecto</label>
        <input type="text" name="nombrePro" id="nombrePro" placeholder="Titulo proyecto" value="<?php echo $nombre ?>">
        <label for="numero_personas">Numero de Participantes</label>
        <input type="text" name="numero_personas" id="numero_personas" placeholder="Numero de Participantes" value="<?php echo $numeroPersonas ?>">
        <label for="duracion">Duracion del Proyecto</label>
        <input type="text" name="duracion" id="duracion" placeholder="Duracion del Proyecto" value="<?php echo $duracion ?>">
        <label for="dificultad">Dificultad del Proyecto</label>
        <input type="text" name="dificultad" id="dificultad" placeholder="Dificultad del Proyecto" value="<?php echo $dificultad ?>">
        <label for="metodologia">Metodologias</label>
        <input type="text" name="metodologia" id="metodologia" placeholder="Metodologias" value="<?php echo $metodologia ?>">

        <input type="submit" value="Actualizar Proyecto" class="btn_save">
      </form>
    </div>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
7
