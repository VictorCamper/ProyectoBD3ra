<?php
    $id =  $_POST["id"];

    switch ($_POST["method"]) {
      case 'delete':
        delete();
        break;
      case 'modify':
        modify();
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
?>
