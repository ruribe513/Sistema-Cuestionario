<nav>
  <ul>
    <!--<li><a href="#">Inicio</a></li>-->
    <?php
    if ($_SESSION['rol'] == 1) {
      ?>
    <li class="principal">
      <a href="#">Usuarios</a>
      <ul>
        <li><a href="registro_usuario.php">Nuevo Usuario</a></li>
        <li><a href="lista_usuarios.php">Lista de Usuarios</a></li>
      </ul>
    </li>
    <li class="principal">
      <a href="#">Proyectos</a>
      <ul>
        <li><a href="registro_proyecto.php">Nuevo Proyecto</a></li>
        <li><a href="lista_proyectos.php">Lista de Proyectos</a></li>
      </ul>
    </li>
    <?php } ?>
    <!--<li class="principal">
      <a href="resultados.php">Analisis de Cuestionario</a>
      <ul>
        <li><a href="#">Nuevo Proveedor</a></li>
        <li><a href="#">Lista de Proveedores</a></li>
      </ul>
    </li>

    <li class="principal">
      <a href="#">Productos</a>
      <ul>
        <li><a href="#">Nuevo Producto</a></li>
        <li><a href="#">Lista de Productos</a></li>
      </ul>
    </li>
    <li class="principal">
      <a href="#">Facturas</a>
      <ul>
        <li><a href="#">Nuevo Factura</a></li>
        <li><a href="#">Facturas</a></li>
      </ul>
    </li>-->
  </ul>
</nav>
