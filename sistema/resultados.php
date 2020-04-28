<?php
session_start();
include "../database.php";
error_reporting(0);
$idproyec = $_GET['id'];

$sql = mysqli_query($conection, "SELECT c.idProyec FROM cuestionario c");
$result_sql = mysqli_fetch_array($sql);
$proyecto = $result_sql['idProyec'];
if ($proyecto == $idproyec) {
  $query = mysqli_query($conection, "SELECT COUNT(*) AS motivados FROM cuestionario_diligenciado_respuestas cd WHERE cd.id_Proyecto = $idproyec AND cd.analisis = '1'");
  $result_motivado = mysqli_fetch_array($query);
  $query2 = mysqli_query($conection, "SELECT COUNT(*) AS desmotivados FROM cuestionario_diligenciado_respuestas cd WHERE cd.id_Proyecto = $idproyec AND cd.analisis = '0'");
  $result_desmotivado = mysqli_fetch_array($query2);

  $total = $result_motivado['motivados'] + $result_desmotivado['desmotivados'];

  $porcen = ($result_motivado['motivados'] / $total ) * 100;

  if ($porcen >= 70) {
    $mensaje = "Muy bien, tu equipo presenta un nivel de motivacion ".$porcen."%";
  }else {
    $mensaje = "El porcentaje actual de motivacion de tu equipo es de ".$porcen."%";
    $mensaje2 = "<br>Para que los niveles de motivacion del equipo aumenten te recomendamos algunos consejos:<br><br>
    -  Promover que los participantes cambien en ciertas tareas o actividades durante el transcurso del desarrollo del proyecto.<br>
    -  Realizar reuniones esporadicamente con todos los participantes para tomar notas de las dificultades o problemas que presentan.<br>
    -  Evaluar el numero de metas que se plantean ya que es probable que haya un exceso trabajo.<br>
    -  Promover el reconocimiento a los participantes que cumplan con las metas propuestas mediante reuniones grupales e incentivos.";
  }

  $query3 = mysqli_query($conection, "SELECT COUNT(*) AS no_contestadas FROM cuestionario_diligenciado c WHERE c.id_Proyecto = $idproyec AND estado = 'N'");
  $result3 = mysqli_fetch_array($query3);
  $personas_nocontes = $result3['no_contestadas'];

  $query4 = mysqli_query($conection, "SELECT COUNT(*) AS contestadas FROM cuestionario_diligenciado c WHERE c.id_Proyecto = $idproyec AND estado = 'S'");
  $result4 = mysqli_fetch_array($query4);
  $personas_contes = $result4['contestadas'];

  $totalpersonas = $personas_nocontes + $personas_contes;

  $mensajepersonas = "Personas que han contestado: ".$personas_contes."/".$totalpersonas;

}else{
  $mensajepersonas = "Aún no se ha generado un analisis de cuestionario para este proyecto";
  $mensaje = "Por favor ve a la lista de proyectos y de click en:";
  $mensaje2 = "Generar Cuestionario y espera a que al menos uno de los participantes haya respondido el cuestionario.";
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
    <h3><?php echo $mensajepersonas; ?></h3>
    <br>
    <h3><?php echo $mensaje;?></h3>
    <h4><?php echo $mensaje2; ?></h4>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
