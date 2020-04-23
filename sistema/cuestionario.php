<?php
session_start();

include "../database.php";

$idProyecto = $_GET["proyectoid"];
$iduser = $_SESSION['idUser'];

if (!empty($_POST)) {

  $query_pregunta = mysqli_query($conection, "SELECT cp.pregunta, cp.id_Cuestionario FROM cuestionario_preguntas cp WHERE cp.id_Cuestionario = $idProyecto");
  $result_pregunta = mysqli_num_rows($query_pregunta);
  if ($result_pregunta > 0) {
    while ($data = mysqli_fetch_array($query_pregunta)) {
      $Pregunta = $data['pregunta'];
    }
    if (is_array($Pregunta) || is_object($Pregunta)) {
      foreach ($Pregunta as $key => $value) {
        echo "Indice:".$key.", ".$value."<br>";
      }
    }
  }
  /*if ($_POST['checkbox'] != " ") {
    if (is_array($_POST['checkbox'])) {
      while (list($key,$value) = each($_POST['checkbox'])) {
        $sql = mysqli_query($conection, "INSERT INTO cuestionario_diligenciado_respuestas(respuesta, pregunta, idUser) VALUES('$value','$Pregunta', '$iduser')");
      }
    }
  }*/

  /*if ($_POST['checkbox'] != "") {
    if (is_array($_POST['checkbox'])) {
      while (list($key,$value) = each($_POST['checkbox'])) {
        $sql = mysqli_query($conection, "INSERT INTO cuestionario_diligenciado_respuestas(respuesta, id_pregunta, idUser) VALUES('$value','$idPregunta', '$iduser')");
      }
    }
  }*/
}

$query = mysqli_query($conection, "SELECT c.idCuestionario, c.idProyec FROM cuestionario c WHERE idProyec = $idProyecto");
while ($data = mysqli_fetch_array($query)) {
  $idCuestio = $data['idCuestionario'];
  $idProyec = $data['idProyec'];
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
    <form action="" method="post">
      <!--<table id="leyenda">
        <tr>
          <th>Totalmente en desacuerdo</th>
        </tr>
        <tr>
          <th>1</th>
        </tr>
      </table>-->
      <table>
        <tr>
          <th>Preguntas</th>
          <th>Opciones</th>
        </tr>
          <?php
          $query2 = mysqli_query($conection, "SELECT cp.idCuesPreg, cp.id_Cuestionario, cp.pregunta FROM cuestionario_preguntas cp WHERE cp.id_Cuestionario = $idCuestio");
          $result = mysqli_num_rows($query2);
          if ($result > 0) {
            while ($data = mysqli_fetch_array($query2)) {
            ?>
            <tr>
              <td><?php echo $data["pregunta"]; ?></td>
              <td>
                <label class="checkboxContainer">1
                  <input name="checkbox[]" type="checkbox" id="checkbox" value="1">
                  <span class="checkmark"></span>
                </label>
                <label class="checkboxContainer">2
                  <input name="checkbox[]" type="checkbox" id="checkbox" value="2">
                  <span class="checkmark"></span>
                </label>
                <label class="checkboxContainer">3
                  <input name="checkbox[]" type="checkbox" id="checkbox" value="3">
                  <span class="checkmark"></span>
                </label>
                <label class="checkboxContainer">4
                  <input name="checkbox[]" type="checkbox" id="checkbox" value="4">
                  <span class="checkmark"></span>
                </label>
                <label class="checkboxContainer">5
                  <input name="checkbox[]" type="checkbox" id="checkbox" value="5">
                  <span class="checkmark"></span>
                </label>
              </td>
            </tr>
          <?php
          }
        }
        ?>
      </table>
      <input type="submit" value="Enviar Respuestas" class="btn_result">
    </form>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
