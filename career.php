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
      <h1 align="center">Sistema de evaluación docente</h1>
      <hr>
    </div>

    <div class="container" id="datos">
    <nav class="nav nav-tabs">
      <!--<a class="navbar-brand" href="#">Navbar</a>-->
      <div class="nav navbar-nav">
          <a class="nav-item nav-link" href="index.php">Profesores</a>
          <a class="nav-item nav-link active" href="career.php">Carrera/Alumno<span class="sr-only">(current)</span></a>
      </div>
    </nav>

    <h2>Listado</h2>
    <hr>
      <div class="row">
    <div class="col-lg-6">
      <button type="button" data-toggle="modal" data-target=".modalAdd" class="btn btn-primary">Agregar carrera</button>
    </div>
    <div class="col-lg-6">
      <div class="input-group">
        <input type="text" class="form-control" id="inputCarrera" placeholder="Codigo carrera">
        <span class="input-group-btn">
          <button class="btn btn-secondary" onclick="loadCarrera()" type="button">Buscar carrera</button>
        </span>
      </div>
    </div>
  </div>
    <hr>

    <script src="script.js"></script>
    <script>
        loadCarrera();
    </script>
    <div class="container" id="main-table">

    </div>
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
