<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";

if (empty($_GET['id'])) {
  header('Location: lista_proyectos.php');
}

$idproyect = $_GET['id'];
$query = mysqli_query($conection, "SELECT p.idProyecto, p.nombrePro FROM proyectos p WHERE p.idProyecto = $idproyect");
$result = mysqli_num_rows($query);
if ($result > 0) {
  while ($data = mysqli_fetch_array($query)) {
    $nombre = $data['nombrePro'];
    $query_insert = mysqli_query($conection, "INSERT INTO cuestionario(idProyec,nombreCues) VALUES('$idproyect','$nombre')");
  }
}

$query2 = mysqli_query($conection, "SELECT c.idCuestionario FROM cuestionario c");
while ($data = mysqli_fetch_array($query2)){
$idCuestionario = $data['idCuestionario'];
//$sql = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario, pregunta, tipo_respuesta) VALUES('$idCuestionario','Hola','1')");
}
$query3 = mysqli_query($conection, "SELECT p.idProyecto , p.numero_personas, p.duracion, p.dificultad, p.metodologia FROM proyectos p WHERE idProyecto = $idproyect");
while ($data = mysqli_fetch_array($query3)){
  $numeroPersonas = $data['numero_personas'];
  $duracion = $data['duracion'];
  $dificultad = $data['dificultad'];
  $metodologia = $data['metodologia'];
}

$sql = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿Consideras que el numero de personas es suficiente para el desarrollo del proyecto?','1')");
$sql2 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿Consideras que el numero de tecnologias implementadas es suficiente?','1')");
$sql3 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿La cantidad de metas estipuladas es la idónea?','1')");
$sql4 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿La comunicacion con el gerente del proyecto es asertiva?','1')");
$sql5 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿El trabajo realizado es bien remunerado?','1')");
$sql6 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿El trabajo realizado es elogiado por las demas personas del equipo?','1')");
$sql7 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿Me siento comodo con las metas propuestas?','1')");
$sql8 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿El tiempo para la entrega de metas es suficiente?','1')");
$sql9 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿Los recursos tecnologicos son los suficientes para el desarrollo del proyecto?','1')");
//$sql10 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿La documentacion en el proyecto es suficiente para el cumplimeinto de las metas?','1')");
$sql11 = mysqli_query($conection, "INSERT INTO cuestionario_preguntas(id_Cuestionario,pregunta,tipo_respuesta) VALUES('$idCuestionario','¿Estas satisfecho con el rol que tienes dentro del grupo?','1')");

$query4 = mysqli_query($conection, "SELECT u.idUsuario, u.proyecto_id FROM users u");
while ($data = mysqli_fetch_array($query4)) {
  $idUsuario = $data['idUsuario'];
  $idProyec = $data['proyecto_id'];
  if ($idProyec == $idproyect) {
    $query4_insert = mysqli_query($conection, "INSERT INTO cuestionario_diligenciado(id_Usuario, id_Cuestionario,id_Proyecto,estado) VALUES('$idUsuario','$idCuestionario','$idProyec','N')");
  }
}



 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<?php include "includes/scripts.php" ?>
 	<title>Cuestionario Generado</title>
 </head>
 <body>
   <?php include "includes/header.php" ?>
   <section id="container">
     <h3>Cuestionario Generado Satisfactoriamente</h3>
   </section>

 </body>
 </html>
