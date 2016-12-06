<?php
    $id =  $_POST["id"];

    switch ($_POST["method"]) {
      case 'delete':
        delete();
        break;
      case 'modify':
        modify();
        break;
      case 'add':
        add();
        break;
      case 'loadProfesor':
        loadProfesor();
        break;
      case 'loadCarrera':
        loadCarrera();
        break;
      default:
        # code...
        break;
    }
    function delete()
    {
      $id = $_POST["id"];
      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "DELETE FROM profesor WHERE rutProfesor = '";
      $query .= $id;
      $query .= "'";
      header("refresh:0;");
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }

    function modify()
    {
      $id=$_POST["id"];
      $name=$_POST["name"];
      $lastName=$_POST["lastName"];
      $age=$_POST["age"];
      $department=$_POST["department"];
      header("refresh:0;");
      $db = pg_connect("dbname=evaluacion user=postgres password=putalawea");
      $query = "UPDATE profesor SET nombre='$name', apellido='$lastName', edad='$age', departamento='$department' WHERE rutprofesor='$id'";
      $result = pg_query($db,$query);
      echo '<script>parent.window.location.reload(true);</script>';
      return $result;
    }
    function add()
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
        while ($line = pg_fetch_row($result)) {
          echo '<tr>';
          echo '<th scope=row>',$line[0],'</th>';
          echo '<td>',$line[1],'</td>';
          echo '<td><button style="margin-right:10px;" type="button" data-toggle="modal" data-target=".md',$i,'" class="btn btn-primary buttonModificar">Modificar</button>
                <button type="button" style="margin-right:10px;"data-toggle="modal" data-target=".m',$i,'" class="btn btn-danger buttonEliminar" >Eliminar</button>
                <button type="button" class="btn btn-info">Información</button></td></td>';
          echo '</tr>';
        }

      echo '</table>';
    }

?>
