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
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
		<h1>Lista de Usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear Usuario</a>

    <form class="form_search" action="buscar_usuario.php" method="get">
      <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
      <input type="submit" class="btn_search" value="Buscar">
    </form>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
        <th>Tiempo</th>
				<th>Rol</th>
        <th>Proyecto</th>
				<th>Acciones</th>
			</tr>
			<?php
          //paginador
          $sql_register = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM users WHERE estatus = 1");
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

					$query= mysqli_query($conection, "SELECT u.idUsuario, u.email, u.user, u.tiempo_empresa, r.rol , p.nombrePro FROM users u INNER JOIN roles r ON u.rol_id = r.idRol INNER JOIN proyectos p ON u.proyecto_id = p.idProyecto WHERE estatus =1 ORDER BY u.idUsuario ASC LIMIT $desde, $por_pagina ");
          mysqli_close($conection);
          $result = mysqli_num_rows($query);

					if ($result > 0) {
						while ($data = mysqli_fetch_array($query)) {

			?>
					<tr>
						<td><?php echo $data["idUsuario"]; ?></td>
						<td><?php echo $data["user"]; ?></td>
						<td><?php echo $data["email"]; ?></td>
            <td><?php echo $data["tiempo_empresa"]; ?></td>
						<td><?php echo $data["rol"]; ?></td>
            <td><?php echo $data["nombrePro"] ?></td>
						<td>
							<a class="link_edit" href="editar_usuario.php?id=<?php echo $data["idUsuario"]; ?>">Editar</a>

              <?php if ($data["idUsuario"] != 1) {?>
							|
							<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["idUsuario"]; ?>">Eliminar</a>
              |
              <a class="link_edit" href="lista_habilidades_usuario.php?id=<?php echo $data["idUsuario"]; ?>">Habilidades</a>
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
