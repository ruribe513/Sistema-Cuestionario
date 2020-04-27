<?php
if (empty($_SESSION['active'])) {
  header('location: ../');
}
 ?>
<header>
  <div class="header">

    <h1>Sistema</h1>
    <div class="optionsBar">
      <p>Colombia, <?php echo fechaC(); ?></p>
      <span>|</span>
      <span class="user"><?php echo $_SESSION['nombre'].' -'.$_SESSION['rol']; ?></span>
      <?php
        if ($_SESSION['rol'] == 1) {
       ?>
      <img class="photouser" src="img/jefe.png" alt="Usuario">
    <?php }else { ?>
      <img class="photouser" src="img/user.png" alt="Usuario">
    <?php } ?>
      <a href="logout.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
    </div>
  </div>
  <?php include "nav.php" ?>
</header>
