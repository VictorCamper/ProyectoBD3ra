<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Sistema de evaluación docente</title>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </head>
  <body>

    <div class="page-header">
      <h1 align="center">Sistema de evaluacion docente</h1>
      <hr>
    </div>

    <div class="container" id="datos">
    <nav class="nav nav-tabs">
      <!--<a class="navbar-brand" href="#">Navbar</a>-->
      <div class="nav navbar-nav">
          <a class="nav-item nav-link active" href="index.php">Listado <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link" href="insert.php">Inserción</a>
          <a class="nav-item nav-link" href="update.php">Modificación</a>
      </div>
    </nav>

    <h2>Listado</h2>
    <hr>
      <div class="row">
    <div class="col-lg-6">
      <button type="button" data-toggle="modal" data-target=".modalAdd" class="btn btn-primary">Agregar Profesor</button>
    </div>
    <div class="col-lg-6">
      <div class="input-group">
        <input type="text" class="form-control" id="input" placeholder="Rut">
        <span class="input-group-btn">
          <button class="btn btn-secondary" onclick="load()" type="button">Buscar profesor</button>
        </span>
      </div>
    </div>
  </div>
    <hr>

    <script src="script.js"></script>
    <script>
        load();
    </script>
  <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Rut</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Edad</th>
      <th>Departamento</th>
      <th>Puntuacion evaluacion</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php
    #if($id==''){
      $sql = "SELECT * FROM profesor ORDER BY profesor.rutprofesor";
    #}
    #else {
    #  $sql = "SELECT * FROM profesor WHERE rutprofesor='$id' ORDER BY profesor.rutprofesor";
    #}
    $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
    #$sql = "SELECT * FROM profesor ORDER BY profesor.rutprofesor";
    $result = pg_query($db,$sql);

    $i = 0;
    while ($line = pg_fetch_row($result)){
      echo '<script> console.log("gg");</script>';
      echo '<tr>';
      echo '<th scope=row id="id',$i ,'">', $line[0],'</th>';
      echo '<td>', $line[1], '</td>';
      echo '<td>', $line[2], '</td>';
      echo '<td>', $line[3], '</td>';
      echo '<td>', $line[4], '</td>';
      echo '<td>', $line[5], '</td>';
      echo '<td><button style="margin-right:10px;" type="button" data-toggle="modal" data-target=".md',$i,'" class="btn btn-primary buttonModificar">Modificar</button><button type="button" data-toggle="modal" data-target=".m',$i,'" class="btn btn-danger buttonEliminar" >Eliminar</button></td>';
      echo '</tr>';
      echo '<div class="modal fade bd-example md',$i,'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hiden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Modificación de instancia</h4>
          </div>
          <div class="modal-body">
            <form class="form-inline" id="form-input',$line[0],'">
              <div class="form-group">
                <label for="inputNombre">Nombre</label>
                <input type="text"  class="form-control" id="inputNombre',$line[0],'" placeholder="Nombre">
              </div>
              <div class="form-group">
                <label for="inputApellido">Apellido</label>
                <input type="text"  class="form-control" id="inputApellido',$line[0],'" placeholder="Apellido">
              </div>
              <div class="form-group">
                <label for="inputEdad">Edad</label>
                <input type="integer"  class="form-control" id="inputEdad',$line[0],'" placeholder="Edad">
              </div><div class="form-group">
                <label for="inputDepartamento">Departamento</label>
                <input type="text"  class="form-control" id="inputDepartamento',$line[0],'" placeholder="Departamento">
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
            <button style="margin-right:10px;" type="button"class="btn btn-primary" data-dismiss="modal" onclick="modifyInstance(this.id);" id="',$line[0],'">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade bd-example-modal-lg m',$i,'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hiden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Eliminación de instancia</h4>
          </div>
          <div class="modal-body">
            ¿Seguro que desea eliminar la instancia?
          </div>
          <div class="modal-footer">
            <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
            <button type="button"class="btn btn-danger" data-dismiss="modal" onclick="deleteInstance(this.id);" id="',$line[0],'">Eliminar</button>
          </div>
        </div>
      </div>
    </div>

';

  $i = $i + 1;
}
     ?>
  </tbody>
  </table>


<div class="modal fade bd-example modalAdd" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hiden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="myModalLabel">Agregar instancia</h4>
    </div>
    <div class="modal-body">
      <form class="form" id="form-add">
        <div class="form-group">
          <label for="inputRut">Rut</label>
          <input type="text" class="form-control" id="inputRut" placeholder="Rut">
        </div>
        <div class="form-group">
          <label for="inputNombre">Nombre</label>
          <input type="text"  class="form-control" id="inputNombre" placeholder="Nombre">
        </div>
        <div class="form-group">
          <label for="inputApellido">Apellido</label>
          <input type="text"  class="form-control" id="inputApellido" placeholder="Apellido">
        </div>
        <div class="form-group">
          <label for="inputEdad">Edad</label>
          <input type="integer"  class="form-control" id="inputEdad" placeholder="Edad">
        </div><div class="form-group">
          <label for="inputDepartamento">Departamento</label>
          <input type="text"  class="form-control" id="inputDepartamento" placeholder="Departamento">
        </div>
      </form>

    </div>
    <div class="modal-footer">
      <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
      <button style="margin-right:10px;" type="button"class="btn btn-primary" data-dismiss="modal" onclick="addInstance();">Aceptar</button>
    </div>
  </div>
</div>
</div>
</div>
  <div id="mostrardatos">

  </div>
</div>







  <script src="script.js"></script>
  </body>
</html>
