<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";
if (!empty($_POST)) {
  $alert='';
  if(empty($_POST['idProyecto']) || empty($_POST['nombrePro']) || empty($_POST['numero_personas']) ||  empty($_POST['duracion'])  || empty($_POST['dificultad']) || empty($_POST['metodologia']))
  {
    $alert='<p class="msg_error">Todos los campos son Obligatorios</p>';
  }else {

    $idProyecto = $_POST['idProyecto'];
    $nombre = $_POST['nombrePro'];
    $numeroPersonas  = $_POST['numero_personas'];
    $duracion  = $_POST['duracion'];
    $dificultad = $_POST['dificultad'];
    $metodo = $_POST['metodologia'];

    $query = mysqli_query($conection,"SELECT * FROM proyectos WHERE nombrePro = '$nombre' OR idProyecto = '$idProyecto'");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
      $alert='<p class="msg_error">El ID, correo o proyecto ya existe</p>';
    }else {
      $query_insert = mysqli_query($conection, "INSERT INTO proyectos(idProyecto,nombrePro,numero_personas,duracion,dificultad,metodologia)  VALUES ('$idProyecto','$nombre','$numeroPersonas','$duracion','$dificultad','$metodo')");
      if ($_POST['checkbox'] != "") {
        if (is_array($_POST['checkbox'])) {
          while (list($key,$value) = each($_POST['checkbox'])) {
            $sql = mysqli_query($conection, "INSERT INTO proyec_tecno(tecnoProyec, pertenece_a_proyec) VALUES('$value','$idProyecto')");
          }
        }
      }

      if ($query_insert) {
        $alert='<p class="msg_save">Proyecto creado correctamente</p>';
      }else {
        $alert='<p class="msg_error">Error al crear el proyecto</p>';
      }
    }
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Registro Proyecto</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
    <div class="form_register">
      <h1>Registrar Proyecto</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
      <form action="" method="post">
        <label for="idProyecto">ID</label>
        <input type="text" name="idProyecto" id ="idProyecto" placeholder="ID">
        <label for="nombrePro">Titulo Proyecto</label>
        <input type="text" name="nombrePro" id="nombrePro" placeholder="Titulo proyecto">
        <label for="numero_personas">Numero de Participantes</label>
        <input type="text" name="numero_personas" id="numero_personas" placeholder="Numero de Participantes">
        <label for="duracion">Duracion del Proyecto</label>
        <input type="text" name="duracion" id="duracion" placeholder="Duracion del Proyecto">
        <label for="dificultad">Dificultad del Proyecto</label>
        <input type="text" name="dificultad" id="dificultad" placeholder="Dificultad del Proyecto">
        <label for="metodologia">Metodologias</label>
        <input type="text" name="metodologia" id="metodologia" placeholder="Metodologias">
        <label for="proyec_tecno">Tipos de Tecnologia</label>
        <table>
          <tr>
            <label class="checkboxContainer">Java
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Java">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">SQL
              <input name="checkbox[]" type="checkbox" id="checkbox" value="SQL">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">Python
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Python">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">C++
              <input name="checkbox[]" type="checkbox" id="checkbox" value="C++">
              <span class="checkmark"></span>
            </label>
          </tr>
          <tr>
            <label class="checkboxContainer">C#
              <input name="checkbox[]" type="checkbox" id="checkbox" value="C#">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">Visual Basic.NET
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Visual Basic.NET">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">JavaScript
              <input name="checkbox[]" type="checkbox" id="checkbox" value="JavaScript">
              <span class="checkmark"></span>
            </label>
          </tr>
          <tr>
            <label class="checkboxContainer">PHP
              <input name="checkbox[]" type="checkbox" id="checkbox" value="PHP">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">Swift
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Swift">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">Ruby
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Ruby">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">C
              <input name="checkbox[]" type="checkbox" id="checkbox" value="C">
              <span class="checkmark"></span>
            </label>
          </tr>
        </table>
        <!--<table>
          <tr>
            <label class="checkboxContainer">Scrum
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Scrum">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">Cascada
              <input name="checkbox[]" type="checkbox" id="checkbox" value="Cascada">
              <span class="checkmark"></span>
            </label>
            <label class="checkboxContainer">RUP
              <input name="checkbox[]" type="checkbox" id="checkbox" value="RUP">
              <span class="checkmark"></span>
            </label>
          </tr>
        </table>-->

        <input type="submit" value="Crear Proyecto" class="btn_save">
      </form>
    </div>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
