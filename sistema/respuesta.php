<?php
session_start();
include "../database.php";
if (empty($_GET['id'])) {
  header('Location: cuestionario.php');
}
$iduser = $_SESSION['idUser'];
$idproyec = $_SESSION['proyecto'];

$idPregunta = $_GET['id'];

if (!empty($_POST)) {
  $alert='';
  if ($_POST['checkbox'] != "") {
    if (is_array($_POST['checkbox'])) {
      while (list($key,$value) = each($_POST['checkbox'])) {
        if ($value <= 3) {
          $sql = mysqli_query($conection, "INSERT INTO cuestionario_diligenciado_respuestas(respuesta, id_pregunta,idUser,analisis, id_Proyecto) VALUES('$value','$idPregunta','$iduser','0',$idproyec)");
        }else {
          $sql = mysqli_query($conection, "INSERT INTO cuestionario_diligenciado_respuestas(respuesta, id_pregunta,idUser,analisis, id_Proyecto) VALUES('$value','$idPregunta','$iduser','1',$idproyec)");
        }
      }
    }
  }
  if ($sql) {
    $alert='<p class="msg_save">Respuesta Guardada</p>';
    header('location: cuestionario.php?proyectoid='.$_SESSION['proyecto']);
  }else {
    $alert='<p class="msg_error">Error al guardar respuesta</p>';
  }
}


$sql = mysqli_query($conection, "SELECT cd.idCuesPreg, cd.pregunta FROM cuestionario_preguntas cd WHERE idCuesPreg = $idPregunta");
while ($data = mysqli_fetch_array($sql)) {
  $pregunta = $data['pregunta'];
}

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
    <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
    <h3><?php echo $pregunta; ?></h3>
    <form action="" method="post">
      <table>
        <tr>
          <label class="checkboxContainer">Totalmente en desacuerdo
            <input name="checkbox[]" type="checkbox" id="checkbox" value="1">
            <span class="checkmark"></span>
          </label>
          <label class="checkboxContainer">En desacuerdo
            <input name="checkbox[]" type="checkbox" id="checkbox" value="2">
            <span class="checkmark"></span>
          </label>
          <label class="checkboxContainer">Indiferente
            <input name="checkbox[]" type="checkbox" id="checkbox" value="3">
            <span class="checkmark"></span>
          </label>
          <label class="checkboxContainer">De acuerdo
            <input name="checkbox[]" type="checkbox" id="checkbox" value="4">
            <span class="checkmark"></span>
          </label>
          <label class="checkboxContainer">Totalmente de acuerdo
            <input name="checkbox[]" type="checkbox" id="checkbox" value="5">
            <span class="checkmark"></span>
          </label>
        </tr>
      </table>
      <input type="submit" value="Enviar Respuesta" class="btn_save">
    </form>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
