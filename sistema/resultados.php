<?php
session_start();
include "../database.php";

$idproyec = $_GET['id'];

$query = mysqli_query($conection, "SELECT COUNT(*) AS motivados FROM cuestionario_diligenciado_respuestas cd WHERE cd.id_Proyecto = $idproyec AND cd.analisis = '1'");
$result_motivado = mysqli_fetch_array($query);
$query2 = mysqli_query($conection, "SELECT COUNT(*) AS desmotivados FROM cuestionario_diligenciado_respuestas cd WHERE cd.id_Proyecto = $idproyec AND cd.analisis = '0'");
$result_desmotivado = mysqli_fetch_array($query2);

$total = $result_motivado['motivados'] + $result_desmotivado['desmotivados'];

$porcen = ($result_motivado['motivados'] / $total ) * 100;

if ($porcen >= 70) {
  $mensaje = "Muy bien, tu equipo presenta un nivel de motivacion ".$porcen."% ";
}else {
  $mensaje = "El porcentaje actual de motivacion de tu equipo es de ".$porcen."%";
  $mensaje2 = "<br>Para que los niveles de motivacion del equipo aumenten te recomendamos algunos consejos:<br><br>
  -  Promover que los participantes cambien en ciertas tareas o actividades durante el transcurso del desarrollo del proyecto.<br>
  -  Realizar reuniones esporadicamente con todos los participantes para tomar notas de las dificultades o problemas que presentan.<br>
  -  Evaluar el numero de metas que se plantean ya que es probable que haya un exceso trabajo.<br>
  -  Promover el reconocimiento a los participantes que cumplan con las metas propuestas mediante reuniones grupales e incentivos.";
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
    <h3><?php echo $mensaje; ?></h3>
    <h4><?php echo $mensaje2; ?></h4>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
