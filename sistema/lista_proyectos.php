<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Lista de Proyectos</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
		<h1>Lista de Proyectos</h1>
		<a href="registro_proyecto.php" class="btn_new">Crear Proyecto</a>

    <form class="form_search" action="buscar_proyecto.php" method="get">
      <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
      <input type="submit" class="btn_search" value="Buscar">
    </form>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Numero de Participantes</th>
				<th>Duracion</th>
        <th>Dificultad</th>
        <th>Metodologia</th>
        <th>Acciones</th>
			</tr>
			<?php
          //paginador
          $sql_register = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM proyectos");
          $result_register = mysqli_fetch_array($sql_register);
          $total_registro = $result_register['total_registro'];

          $por_pagina = 5;

          if (empty($_GET['pagina'])) {
            $pagina = 1;
          }else {
            $pagina = $_GET['pagina'];
          }

          $desde = ($pagina-1) * $por_pagina;
          $total_paginas = ceil($total_registro / $por_pagina);

					$query= mysqli_query($conection, "SELECT p.idProyecto, p.nombrePro, p.numero_personas, p.duracion, p.dificultad, p.metodologia FROM proyectos p ORDER BY p.idProyecto ASC LIMIT $desde, $por_pagina ");
          mysqli_close($conection);
          $result = mysqli_num_rows($query);

					if ($result > 0) {
						while ($data = mysqli_fetch_array($query)) {

			?>
					<tr>
						<td><?php echo $data["idProyecto"]; ?></td>
						<td><?php echo $data["nombrePro"]; ?></td>
						<td><?php echo $data["numero_personas"]; ?></td>
						<td><?php echo $data["duracion"]; ?></td>
            <td><?php echo $data["dificultad"]; ?></td>
            <td><?php echo $data["metodologia"]; ?></td>
						<td>
              <?php if ($data["idProyecto"] != 1) { ?>
							<a class="link_edit" href="editar_proyecto.php?id=<?php echo $data["idProyecto"]; ?>">Editar</a>
              |
							<a class="link_delete" href="eliminar_confirmar_proyecto.php?id=<?php echo $data["idProyecto"]; ?>">Eliminar</a>
              |
              <a class="link_edit" href="lista_participantes.php?id=<?php echo $data["idProyecto"]; ?>">Participantes</a>
              |
              <a class="link_edit" href="generar_cuestionario.php?id=<?php echo $data["idProyecto"];?>">Generar Cuestionario</a>
            <?php } ?>
            </td>
					</tr>
	<?php
				}
			}
	?>
		</table>
    <div class="paginador">
      <ul>
        <?php
          if ($pagina != 1) {

         ?>
        <li> <a href="?pagina=<?php echo 1; ?>">|<</a> </li>
        <li> <a href="?pagina=<?php echo $pagina-1; ?>">|<<</a> </li>

        <?php
      }
          for ($i=1; $i <= $total_paginas; $i++) {
            if ($i == $pagina) {
              echo '<li class="pageSelected">'.$i.'</li>';
            }else {
              echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
            }
          }

          if ($pagina != $total_paginas) {
         ?>
        <li> <a href="?pagina=<?php echo $pagina+1; ?>">>></a> </li>
        <li> <a href="?pagina=<?php echo $total_paginas; ?>">>|</a> </li>
      <?php } ?>
      </ul>
    </div>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
