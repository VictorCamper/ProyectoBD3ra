<?php

    switch ($_POST["method"]) {
      case 'deleteProfesor':
        deleteProfesor();
        break;
      case 'modifyProfesor':
        modifyProfesor();
        break;
      case 'addProfesor':
        addProfesor();
        break;
      case 'loadProfesor':
        loadProfesor();
        break;
      case 'loadCarrera':
        loadCarrera();
        break;
      case 'deleteCarrera':
        deleteCarrera();
        break;
      case 'modifyCarrera':
        modifyCarrera();
        break;
      case 'addCarrera':
        addCarrera();
        break;
      case 'loadAlumno':
        loadAlumno();
        break;
      case 'deleteAlumno':
        deleteAlumno();
        break;
      case 'modifyAlumno':
        modifyAlumno();
        break;
      case 'addAlumno':
        addAlumno();
        break;
      case 'verAlumno':
        verAlumno();
        break;
      default:
        # code...
        break;
    }

    function deleteProfesor()
    {
      $id = $_POST["id"];
      echo '<script> console.log("gg");</script>';

      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "DELETE FROM profesor WHERE rutProfesor = '";
      $query .= $id;
      $query .= "'";
      header("refresh:0;");
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      #$out = '<script>console.log("';
      #$out .= $query;
      #$out .= '");';
      #echo $out;
      return $result;
    }

    function modifyProfesor()
    {
      $id=$_POST["id"];
      $newId=$_POST["newId"];
      $name=$_POST["name"];
      $lastName=$_POST["lastName"];
      $age=$_POST["age"];
      $department=$_POST["department"];
      header("refresh:0;");
      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "UPDATE profesor SET rutprofesor='$newId', nombre='$name', apellido='$lastName', edad='$age', departamento='$department' WHERE rutprofesor='$id'";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }
    function addProfesor()
    {
      $id=$_POST["id"];
      $name=$_POST["name"];
      $lastName=$_POST["lastName"];
      $age=$_POST["age"];
      $department=$_POST["department"];
      $cero = 0;
      header("refresh:0;");
      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "INSERT INTO profesor VALUES ('$id','$name','$lastName',$age,'$department',$cero)";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }

    function loadProfesor()
    {
      $id = $_POST["id"];
      echo '<table class="table table-bordered table-hover" style="table-layout:fixed;">
      <thead>
        <tr>
          <th>Rut</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Edad</th>
          <th>Departamento</th>
          <th>Puntuacion evaluacion</th>
          <th style="width:230px;">Opciones</th>
        </tr>
      </thead>';
      echo '<tbody>';

        if($id==''){
          $sql = "SELECT * FROM profesor ORDER BY profesor.rutprofesor";
        }
        else {
          $sql = "SELECT * FROM profesor WHERE rutprofesor='$id' ORDER BY profesor.rutprofesor";
        }
        $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
        #$sql = "SELECT * FROM profesor ORDER BY profesor.rutprofesor";
        $result = pg_query($db,$sql);

        $i = 0;
        while ($line = pg_fetch_row($result)){
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
                  <label for="inputRut">Nombre</label>
                  <input type="text" value="',$line[0],'" class="form-control" id="inputRut',$line[0],'" placeholder="Rut">
                </div>
                  <div class="form-group">
                    <label for="inputNombre">Nombre</label>
                    <input type="text" value="',$line[1],'" class="form-control" id="inputNombre',$line[0],'" placeholder="Nombre">
                  </div>
                  <div class="form-group">
                    <label for="inputApellido">Apellido</label>
                    <input type="text" value="',$line[2],'" class="form-control" id="inputApellido',$line[0],'" placeholder="Apellido">
                  </div>
                  <div class="form-group">
                    <label for="inputEdad">Edad</label>
                    <input type="integer" value="',$line[3],'" class="form-control" id="inputEdad',$line[0],'" placeholder="Edad">
                  </div><div class="form-group">
                    <label for="inputDepartamento">Departamento</label>
                    <input type="text" value="',$line[4],'" class="form-control" id="inputDepartamento',$line[0],'" placeholder="Departamento">
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
                <button style="margin-right:10px;" type="button"class="btn btn-primary" data-dismiss="modal" onclick="modifyProfesor(this.id);" id="',$line[0],'">Aceptar</button>
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
                <button type="button"class="btn btn-danger" data-dismiss="modal" onclick="deleteProfesor(this.id);" id="',$line[0],'">Eliminar</button>
              </div>
            </div>
          </div>
        </div>
    ';

      $i = $i + 1;
    }
      echo '</tbody>
      </table>';

    }

    function loadCarrera()
    {
      $id = $_POST["id"];
      echo '<table class="table table-bordered table-hover" style="table-layout:fixed;">
      <thead>
        <tr>
          <th>Código carrera</th>
          <th>Nombre carrera</th>
          <th style="width:400px;">Opciones</th>
        </tr>
        </thead>';

        if($id==''){
          $sql = "SELECT * FROM carrera ORDER BY carrera.codcarrera";
        }
        else {
          $sql = "SELECT * FROM carrera WHERE codcarrera='$id' ORDER BY carrera.codcarrera";
        }

        $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
        $result = pg_query($db,$sql);
        $i = 0;
        while ($line = pg_fetch_row($result)) {
          echo '<tr>';
          echo '<th scope=row>',$line[0],'</th>';
          echo '<td>',$line[1],'</td>';
          echo '<td><button style="margin-right:10px;" type="button" data-toggle="modal" data-target=".mdc',$i,'" class="btn btn-primary buttonModificar">Modificar</button>
                <button type="button" style="margin-right:10px;"data-toggle="modal" data-target=".m',$i,'" class="btn btn-danger buttonEliminar" >Eliminar</button>
                <button type="button" onclick="verAlumno(',$line[0],');" class="btn btn-info">Información</button></td></td>';
          echo '</tr>';
          echo '<div class="modal fade bd-example mdc',$i,'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hiden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modificación de carrera</h4>
              </div>
              <div class="modal-body">
                <form class="form-inline" id="form-input',$line[0],'">
                <div class="form-group">
                  <label for="inputCodCarerra',$line[0],'">Código carrera</label>
                  <input type="text" value="',$line[0],'" class="form-control" id="inputCodCarrera',$line[0],'" placeholder="Código Carrera">
                </div>
                  <div class="form-group">
                    <label for="inputNombreCarerra',$line[0],'">Nombre carrera</label>
                    <input type="text" value="',$line[1],'" class="form-control" id="inputNombreCarrera',$line[0],'" placeholder="Nombre Carrera">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
                <button style="margin-right:10px;" type="button"class="btn btn-primary" data-dismiss="modal" onclick="modifyCarrera(this.id);" id="',$line[0],'">Aceptar</button>
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
                <h4 class="modal-title" id="myModalLabel">Eliminación de instancia Carrera</h4>
              </div>
              <div class="modal-body">
                ¿Seguro que desea eliminar la instancia?
              </div>
              <div class="modal-footer">
                <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
                <button type="button"class="btn btn-danger" data-dismiss="modal" onclick="deleteCarrera(this.id);" id="',$line[0],'">Eliminar</button>
              </div>
            </div>
          </div>
        </div>
    ';
    $i = $i + 1;
        }

      echo '</table>';
    }

    function modifyCarrera()
    {
      $id = $_POST["id"];
      $newId = $_POST["codCarrera"];
      $name = $_POST["name"];

      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "UPDATE carrera SET codCarrera=$newId, nombre='$name' WHERE codcarrera=$id";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      echo $query;

      return $result;
    }

    function deleteCarrera()
    {
      $id = $_POST["id"];

      $db = pg_connect("dbname = evaluacion user=postgres password=putalawea");
      $query = "DELETE FROM carrera WHERE codcarrera=$id";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }

    function addCarrera()
    {
      $id = $_POST["id"];
      $name = $_POST["name"];

      $db = pg_connect("dbname = evaluacion user=postgres password=putalawea");
      $query = "INSERT INTO carrera VALUES ($id,'$name')";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      #$query = "INSERT INTO carrera VALUES codcarrera=$id, nombre=',$name,'";
      return result;
    }

    function loadAlumno()
    {

        $id = $_POST["id"];
        echo '<table class="table table-bordered table-hover" style="table-layout:fixed;">
        <thead>
          <tr>
            <th>Número de Matricula</th>
            <th>Nombre alumno</th>
            <th>Carrera</th>
            <th style="width:250px;">Opciones</th>
          </tr>
          </thead>';
          session_start();
          $codCarrera = $_SESSION['codCarrera'];
          if($id==''){
            $sql = "SELECT * FROM alumno WHERE codCarrera=$codCarrera ORDER BY alumno.matricula";
          }
          else {
            $sql = "SELECT * FROM alumno WHERE codCarrera=$codCarrera AND matricula='$id' ORDER BY alumno.matricula";
          }

          $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
          $result = pg_query($db,$sql);
          $i = 0;
          while ($line = pg_fetch_row($result)) {
            $carrera = pg_fetch_row(pg_query($db,"SELECT carrera.nombre FROM carrera WHERE carrera.codCarrera=$codCarrera"))[0];
            echo '<tr>';
            echo '<th scope=row>',$line[0],'</th>';
            echo '<td>',$line[1],'</td>';
            echo '<td>',$carrera,'</td>';
            echo '<td><button style="margin-right:10px;" type="button" data-toggle="modal" data-target=".mda',$i,'" class="btn btn-primary buttonModificar">Modificar</button>
                  <button type="button" style="margin-right:10px;"data-toggle="modal" data-target=".m',$i,'" class="btn btn-danger buttonEliminar" >Eliminar</button>';
            echo '</tr>';
            echo '<div class="modal fade bd-example mda',$i,'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hiden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Modificación de carrera</h4>
                </div>
                <div class="modal-body">
                  <form class="form-inline" id="form-input',$line[0],'">
                  <div class="form-group">
                    <label for="inputMatricula',$line[0],'">Matricula alumno</label>
                    <input type="text" value="',$line[0],'" class="form-control" id="inputMatricula',$line[0],'" placeholder="Número de matricula">
                  </div>
                    <div class="form-group">
                      <label for="inputNombreAlumno',$line[0],'">Nombre alumno</label>
                      <input type="text" value="',$line[1],'" class="form-control" id="inputNombreAlumno',$line[0],'" placeholder="Nombre alumno">
                    </div>
                    <div class="form-group">
                      <label for="inputCarreraPertenece',$line[0],'">Carrera a la que pertenece</label>
                      <input type="text" value="',$line[2],'" class="form-control" id="inputCarreraPertenece',$line[0],'" placeholder="Código carrera">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
                  <button style="margin-right:10px;" type="button"class="btn btn-primary" data-dismiss="modal" onclick="modifyAlumno(this.id);" id="',$line[0],'">Aceptar</button>
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
                  <h4 class="modal-title" id="myModalLabel">Eliminación de instancia Alumno</h4>
                </div>
                <div class="modal-body">
                  ¿Seguro que desea eliminar la instancia?
                </div>
                <div class="modal-footer">
                  <button type="button"class="btn btn-seconday" data-dismiss="modal">Cancelar</button>
                  <button type="button"class="btn btn-danger" data-dismiss="modal" onclick="deleteAlumno(this.id);" id="',$line[0],'">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
      ';
      $i = $i + 1;
          }

        echo '</table>';
    }

    function deleteAlumno()
    {
      $id = $_POST["id"];
      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "DELETE FROM alumno WHERE matricula=$id";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }

    function modifyAlumno()
    {
      $id = $_POST["id"];
      $newId = $_POST["newId"];
      $name = $_POST["name"];
      $career = $_POST["career"];

      $db = pg_connect("dbname = evaluacion user=postgres password=putalawea");
      $query ="UPDATE alumno SET matricula=$newId, nombre='$name', codCarrera=$career WHERE matricula=$id";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      echo $query;
      return $result;
    }

    function addAlumno()
    {
      $id = $_POST["id"];
      $name = $_POST["name"];

      session_start();
      $codCarrera = $_SESSION['codCarrera'];

      $db = pg_connect("dbname = evaluacion user=postgres password=putalawea");
      $query = "INSERT INTO alumno VALUES ($id,'$name',$codCarrera)";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }

    function verAlumno()
    {
      session_start();
      $_SESSION['codCarrera'] = $_POST["codCarrera"];
      //echo $_SESSION["codCarrera"];
      echo "<script>window.location.href = 'student.php';</script>";
    }
?>
