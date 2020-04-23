<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";
if (!empty($_POST)) {
  $alert='';
  if(empty($_POST['user']) || empty($_POST['email']) || empty($_POST['tiempo_empresa']) || empty($_POST['tiempo_experiencia_profe']) || empty($_POST['tiempo_tecnologias']) ||
  empty($_POST['nivel_cumplimiento']) || empty($_POST['nivel_trabajo_equipo']) || empty($_POST['perfil_profesional']) || empty($_POST['perfil_usuario_proyecto']) || empty($_POST['comparte_conocimientos']) || empty($_POST['cumple_metas']) || empty($_POST['flexible_cambio']) || empty($_POST['asume_retos']) ||
  empty($_POST['rol_id']) || empty($_POST['proyecto_id']))
  {
    $alert='<p class="msg_error">Todos los campos son Obligatorios</p>';
  }else {

    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['user'];
    $email  = $_POST['email'];
    $tiempo  = $_POST['tiempo_empresa'];
    $contraseña = md5($_POST['password']);
    $tiempo_exp_pro = $_POST['tiempo_experiencia_profe'];
    $tiempo_tecno = $_POST['tiempo_tecnologias'];
    $nivel_cumpli = $_POST['nivel_cumplimiento'];
    $nivel_trabajo = $_POST['nivel_trabajo_equipo'];
    $perfil_profe = $_POST['perfil_profesional'];
    $perfil_usuario = $_POST['perfil_usuario_proyecto'];
    $comparte_cono = $_POST['comparte_conocimientos'];
    $cumple_metas = $_POST['cumple_metas'];
    $flexible = $_POST['flexible_cambio'];
    $retos = $_POST['asume_retos'];
    $rol = $_POST['rol_id'];
    $proyecto = $_POST['proyecto_id'];


    $query = mysqli_query($conection,"SELECT * FROM users WHERE (user = '$nombre' AND idUsuario != $idUsuario) OR (email = '$email' AND idUsuario != $idUsuario)");

    $result = mysqli_fetch_array($query);

    if ($result > 0) {
      $alert='<p class="msg_error">El correo o usuario ya existe</p>';
    }else {
      if (empty($_POST['password'])) {
        $sql_update = mysqli_query($conection, "UPDATE users SET user = '$nombre', email = '$email', tiempo_empresa = '$tiempo', tiempo_experiencia_profe = '$tiempo_exp_pro', tiempo_tecnologias = '$tiempo_tecno', nivel_cumplimiento = '$nivel_cumpli', nivel_trabajo_equipo = '$nivel_trabajo',
          perfil_profesional = '$perfil_profe', perfil_usuario_proyecto = '$perfil_usuario', comparte_conocimientos = '$comparte_cono', cumple_metas = '$cumple_metas', flexible_cambio = '$flexible', asume_retos = '$retos', rol_id = '$rol', proyecto_id = '$proyecto' WHERE idUsuario = $idUsuario");
      }else {
        $sql_update = mysqli_query($conection, "UPDATE users SET user = '$nombre', email = '$email',  tiempo_empresa = '$tiempo', password = '$contraseña', tiempo_experiencia_profe = '$tiempo_exp_pro', tiempo_tecnologias = '$tiempo_tecno', nivel_cumplimiento = '$nivel_cumpli', nivel_trabajo_equipo = '$nivel_trabajo',
          perfil_profesional = '$perfil_profe', perfil_usuario_proyecto = '$perfil_usuario', comparte_conocimientos = '$comparte_cono', cumple_metas = '$cumple_metas', flexible_cambio = '$flexible', asume_retos = '$retos', rol_id = '$rol', proyecto_id = '$proyecto' WHERE idUsuario = $idUsuario");
      }

      if ($sql_update) {
        $alert='<p class="msg_save">Usuario actualizado correctamente</p>';
      }else {
        $alert='<p class="msg_error">Error al actualizar el usuario</p>';
      }
    }
  }
}

//Mostrar Datos
if (empty($_GET['id'])) {
  header('Location: lista_usuarios.php');
}
$iduser = $_GET['id'];
$sql = mysqli_query($conection, "SELECT u.idUsuario, u.user, u.email, u.tiempo_empresa, u.tiempo_experiencia_profe, u.tiempo_tecnologias, u.nivel_cumplimiento, u.nivel_trabajo_equipo, u.perfil_profesional, u.perfil_usuario_proyecto, u.comparte_conocimientos, u.cumple_metas, u.flexible_cambio, u.asume_retos,
   (u.rol_id) AS idRol, (r.rol) AS rol, (u.proyecto_id) AS idProyecto, (p.nombrePro) AS proyecto FROM users u INNER JOIN roles r ON u.rol_id = r.idRol INNER JOIN proyectos p ON u.proyecto_id = p.idProyecto WHERE idUsuario = $iduser");
//$sql = mysqli_query($conection, "SELECT u.idUsuario, u.user, u.email, u.tiempo_empresa, (u.rol_id) AS idRol, (r.rol) AS rol FROM users u INNER JOIN roles r ON u.rol_id = r.idRol WHERE idUsuario = $iduser");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
  header('Location: lista_usuarios.php');
}else {
  $option = '';
  while ($data = mysqli_fetch_array($sql)) {
    $iduser = $data['idUsuario'];
    $nombre = $data['user'];
    $email = $data['email'];
    $tiempo = $data['tiempo_empresa'];
    $tiempo_exp_pro = $data['tiempo_experiencia_profe'];
    $tiempo_tecno = $data['tiempo_tecnologias'];
    $nivel_cumpli = $data['nivel_cumplimiento'];
    $nivel_trabajo = $data['nivel_trabajo_equipo'];
    $perfil_profe = $data['perfil_profesional'];
    $perfil_usuario = $data['perfil_usuario_proyecto'];
    $comparte_cono = $data['comparte_conocimientos'];
    $cumple_metas = $data['cumple_metas'];
    $flexible = $data['flexible_cambio'];
    $retos = $data['asume_retos'];
    $idrol = $data['idRol'];
    $rol = $data['rol'];
    $idproyecto = $data['idProyecto'];
    $proyecto = $data['proyecto'];

    if ($idrol == 1) {
      $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
    }else if ($idrol == 2) {
      $option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
    }

    if ($idproyecto == 1) {
      $option2 = '<option value="'.$idproyecto.'"select>'.$proyecto.'</option>';
    }elseif ($idproyecto == 2) {
      $option2 = '<option value="'.$idproyecto.'"select>'.$proyecto.'</option>';
    }elseif ($idproyecto == 3) {
      $option2 = '<option value="'.$idproyecto.'"select>'.$proyecto.'</option>';
    }elseif ($idproyecto == 4) {
      $option2 = '<option value="'.$idproyecto.'"select>'.$proyecto.'</option>';
    }elseif ($idproyecto == 5) {
      $option2 = '<option value="'.$idproyecto.'"select>'.$proyecto.'</option>';
    }
  }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
    <div class="form_register">
      <h1>Actualizar Usuario</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
      <form action="" method="post">
        <input type="hidden" name="idUsuario" value="<?php echo $iduser ?>">
        <label for="user">Nombre</label>
        <input type="text" name="user" id="user" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
        <label for="email">Correo Electronico</label>
        <input type="text" name="email" id="email" placeholder="Correo Electronico" value="<?php echo $email; ?>">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Clave de acceso">
        <label for="tiempo_empresa">Tiempo de Pertenencia en la empresa</label>
        <input type="text" name="tiempo_empresa" id="tiempo_empresa" placeholder="Tiempo de Pertenencia en la empresa" value="<?php echo $tiempo; ?>">
        <label for="tiempo_experiencia_profe">Tiempo de Experiencia profesional</label>
        <input type="text" name="tiempo_experiencia_profe" id="tiempo_experiencia_profe" placeholder="Tiempo de experiencia profesional" value="<?php echo $tiempo_exp_pro; ?>">
        <label for="tiempo_tecnologias">Tiempo de Experiencia Tecnologias</label>
        <input type="text" name="tiempo_tecnologias" id="tiempo_tecnologias" placeholder="Tiempo de Experiencia Tecnologias"  value="<?php echo $tiempo_tecno; ?>">
        <label for="nivel_cumplimiento">Nivel de Cumplimiento de Tareas asignadas (0-5)</label>
        <input type="text" name="nivel_cumplimiento" id="nivel_cumplimiento" placeholder="0-5"  value="<?php echo $nivel_cumpli; ?>">
        <label for="nivel_trabajo_equipo">Nivel de Trabajo en equipo (0-5)</label>
        <input type="text" name="nivel_trabajo_equipo" id="nivel_trabajo_equipo" placeholder="0-5"   value="<?php echo $nivel_trabajo; ?>">
        <label for="perfil_profesional">Perfil Profesional</label>
        <input type="text" name="perfil_profesional" id="perfil_profesional" placeholder="Perfil Profesional"   value="<?php echo $perfil_profe; ?>">
        <label for="perfil_usuario_proyecto">Perfil en el proyecto</label>
        <input type="text" name="perfil_usuario_proyecto" id="perfil_usuario_proyecto" placeholder="Perfil en el proyecto"  value="<?php echo $perfil_usuario; ?>">
        <label for="comparte_conocimientos">Comparte conocimientos?</label>
        <input type="text" name="comparte_conocimientos" id="comparte_conocimientos" placeholder="Si/No"   value="<?php echo $comparte_cono; ?>">
        <label for="cumple_metas">Cumple con las metas propuestas?</label>
        <input type="text" name="cumple_metas" id="cumple_metas" placeholder="Si/No"  value="<?php echo $cumple_metas; ?>">
        <label for="flexible_cambio">Es flexible al cambio?</label>
        <input type="text" name="flexible_cambio" id="flexible_cambio" placeholder="Si/No"  value="<?php echo $flexible; ?>">
        <label for="asume_retos">Asume retos?</label>
        <input type="text" name="asume_retos" id="asume_retos" placeholder="Si/No" value="<?php echo $retos; ?>">
        <label for="rol_id">Tipo de usuario</label>
        <?php
        include "../database.php";
          $query_rol= mysqli_query($conection,"SELECT * FROM roles");
          $result_rol=mysqli_num_rows($query_rol);

         ?>
        <select name="rol_id" id="rol_id" class="notItemOne">
          <?php
          echo $option;
          if ($result_rol > 0) {
            while ($rol = mysqli_fetch_array($query_rol)){
          ?>
          <option value="<?php echo $rol["idRol"] ?>"><?php echo $rol["rol"] ?></option>
          <?php
            }
          }
           ?>
        </select>

        <label for="proyecto_id">Proyecto Perteneciente</label>
        <?php
          include "../database.php";
          $query_proyectos= mysqli_query($conection,"SELECT * FROM proyectos");
          $result_proyectos=mysqli_num_rows($query_proyectos);
         ?>
        <select name="proyecto_id" id="proyecto_id" class="notItemOne">
          <?php
          echo $option2;
          if ($result_proyectos > 0) {
            while ($proyecto = mysqli_fetch_array($query_proyectos)){
           ?>
        <option value="<?php echo $proyecto["idProyecto"] ?>"><?php echo $proyecto["nombrePro"] ?></option>
          <?php
              }
            }
           ?>
        </select>

        <input type="submit" value="Actualizar Usuario" class="btn_save">
      </form>
    </div>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
