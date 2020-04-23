<?php
session_start();
if ($_SESSION['rol'] != 1) {
  header("location: ./");
}
include "../database.php";
if (!empty($_POST)) {
  $alert='';
  if(empty($_POST['idUsuario']) || empty($_POST['user']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['tiempo_empresa']) || empty($_POST['tiempo_experiencia_profe']) || empty($_POST['tiempo_tecnologias']) ||
  empty($_POST['nivel_cumplimiento']) || empty($_POST['nivel_trabajo_equipo']) || empty($_POST['perfil_profesional']) || empty($_POST['perfil_usuario_proyecto']) || empty($_POST['comparte_conocimientos']) || empty($_POST['cumple_metas']) || empty($_POST['flexible_cambio']) || empty($_POST['asume_retos']) ||
  empty($_POST['rol_id']) || empty($_POST['proyecto_id']))
  {
    $alert='<p class="msg_error">Todos los campos son Obligatorios</p>';
  }else {

    $idUsuario = $_POST['idUsuario'];
    $nombre = $_POST['user'];
    $email  = $_POST['email'];
    $contraseña = md5($_POST['password']);
    $tiempo  = $_POST['tiempo_empresa'];
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


    $query = mysqli_query($conection,"SELECT * FROM users WHERE user = '$nombre' OR email = '$email' OR idUsuario = '$idUsuario'");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
        $alert='<p class="msg_error">El ID, correo o usuario ya existe</p>';
    }else {
      $query_insert = mysqli_query($conection, "INSERT INTO users(idUsuario, user,password,email,tiempo_empresa,tiempo_experiencia_profe,tiempo_tecnologias,nivel_cumplimiento,nivel_trabajo_equipo,perfil_profesional,perfil_usuario_proyecto,comparte_conocimientos,cumple_metas,flexible_cambio,asume_retos,rol_id,proyecto_id)
      VALUES('$idUsuario','$nombre','$contraseña','$email','$tiempo','$tiempo_exp_pro','$tiempo_tecno','$nivel_cumpli','$nivel_trabajo','$perfil_profe','$perfil_usuario','$comparte_cono','$cumple_metas','$flexible','$retos','$rol','$proyecto')");
      if ($_POST['checkbox'] != "") {
        if (is_array($_POST['checkbox'])) {
          while (list($key,$value) = each($_POST['checkbox'])) {
            $sql = mysqli_query($conection, "INSERT INTO habi_tecno(tecnoHabi, pertenece_a) VALUES('$value','$idUsuario')");
          }
        }
      }
      if ($query_insert and $sql) {
        $alert='<p class="msg_save">Usuario creado correctamente</p>';
      }else {
        $alert='<p class="msg_error">Error al crear el usuario</p>';
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
	<title>Registro Usuario</title>
</head>
<body>
	<?php include "includes/header.php" ?>
	<section id="container">
    <div class="form_register">
      <h1>Registrar Usuario</h1>
      <hr>
      <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>
      <form action="" method="post">
        <label for="idUsuario">ID</label>
        <input type="text" name="idUsuario" id ="idUsuario" placeholder="ID">
        <label for="user">Nombre</label>
        <input type="text" name="user" id="user" placeholder="Nombre completo">
        <label for="email">Correo Electronico</label>
        <input type="text" name="email" id="email" placeholder="Correo Electronico">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Clave de acceso">
        <label for="tiempo_empresa">Tiempo de Pertenencia en la empresa</label>
        <input type="text" name="tiempo_empresa" id="tiempo_empresa" placeholder="Tiempo de pertenencia en la empresa">
        <label for="tiempo_experiencia_profe">Tiempo de Experiencia profesional</label>
        <input type="text" name="tiempo_experiencia_profe" id="tiempo_experiencia_profe" placeholder="Tiempo de experiencia profesional">
        <label for="tiempo_tecnologias">Tiempo de Experiencia Tecnologias</label>
        <input type="text" name="tiempo_tecnologias" id="tiempo_tecnologias" placeholder="Tiempo de Experiencia Tecnologias">
        <label for="nivel_cumplimiento">Nivel de Cumplimiento de Tareas asignadas (0-5)</label>
        <input type="text" name="nivel_cumplimiento" id="nivel_cumplimiento" placeholder="0-5">
        <label for="nivel_trabajo_equipo">Nivel de Trabajo en equipo (0-5)</label>
        <input type="text" name="nivel_trabajo_equipo" id="nivel_trabajo_equipo" placeholder="0-5">
        <label for="perfil_profesional">Perfil Profesional</label>
        <input type="text" name="perfil_profesional" id="perfil_profesional" placeholder="Perfil Profesional">
        <label for="perfil_usuario_proyecto">Perfil en el proyecto</label>
        <input type="text" name="perfil_usuario_proyecto" id="perfil_usuario_proyecto" placeholder="Perfil en el proyecto">
        <label for="comparte_conocimientos">Comparte conocimientos?</label>
        <input type="text" name="comparte_conocimientos" id="comparte_conocimientos" placeholder="Si/No">
        <label for="cumple_metas">Cumple con las metas propuestas?</label>
        <input type="text" name="cumple_metas" id="cumple_metas" placeholder="Si/No">
        <label for="flexible_cambio">Es flexible al cambio?</label>
        <input type="text" name="flexible_cambio" id="flexible_cambio" placeholder="Si/No">
        <label for="asume_retos">Asume retos?</label>
        <input type="text" name="asume_retos" id="asume_retos" placeholder="Si/No">
        <label for="habi_tecno">Habilidades Tecnologicas</label>
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

        <label for="rol_id">Tipo de usuario</label>
        <?php
          $query_rol= mysqli_query($conection,"SELECT * FROM roles");
          $result_rol=mysqli_num_rows($query_rol);

         ?>
        <select name="rol_id" id="rol_id">
          <?php
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
          $query_proyectos = mysqli_query($conection, "SELECT * FROM proyectos");
          $result_proyectos = mysqli_num_rows($query_proyectos);
         ?>
         <select name="proyecto_id" id="proyecto_id">
           <?php
           if ($result_proyectos > 0) {
             while ($proyecto = mysqli_fetch_array($query_proyectos)){
           ?>
           <option value="<?php echo $proyecto["idProyecto"] ?>"><?php echo $proyecto["nombrePro"] ?></option>
           <?php
             }
           }
            ?>
         </select>

        <input type="submit" value="Crear Usuario" class="btn_save">
      </form>
    </div>
	</section>
	<?php include "includes/footer.php" ?>
</body>
</html>
