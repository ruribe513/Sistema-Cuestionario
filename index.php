  <?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
}else {
  if (!empty($_POST)) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
      $alert = "Ingrese su email y contraseña";
    }else {
      require_once "database.php";

      $email = mysqli_real_escape_string($conection,$_POST['email']);
      $pass = md5(mysqli_real_escape_string($conection,$_POST['password']));

      $query = mysqli_query($conection,"SELECT * FROM users WHERE email = '$email' AND password = '$pass'");
      mysqli_close($conection);
      $result = mysqli_num_rows($query);

      if ($result > 0) {
        $data = mysqli_fetch_array($query);


        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idUsuario'];
        $_SESSION['nombre'] = $data['user'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['tiempo'] = $data['tiempo'];
        $_SESSION['rol'] = $data['rol_id'];
        $_SESSION['proyecto'] = $data['proyecto_id'];

        if ($_SESSION['rol'] == 1) {
          header('location: sistema/');
        }else {
          header('location: sistema/cuestionario.php?proyectoid='.$_SESSION['proyecto']);
        }

      }else {
        $alert = 'El usuario o clave es incorrecto';
        session_destroy();
      }
    }
  }
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <section id="container">
      <form action="" method="post">
        <h3>Iniciar Sesion</h3>
        <img src="assets/img/people.png" alt="Login" width="150" height="150">
        <input type="text" name="email" placeholder="Correo">
        <input type="password" name="password" placeholder="Contraseña">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <input type="submit" value="Ingresar">
      </form>

    </section>
  </body>
</html>
