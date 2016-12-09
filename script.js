/*$(document).ready(function(){
    $('.buttonEliminar').on("click",function(){
      console.log(this.id);
    });
  });
*/

function modifyProfesor(clicked){
  var url="funct.php";
  var newId = (document).getElementById('inputRut' + clicked).value;
  var name = (document).getElementById('inputNombre' + clicked).value;
  var lastName = (document).getElementById('inputApellido'+clicked).value;
  var age = (document).getElementById('inputEdad'+clicked).value;
  var department = (document).getElementById('inputDepartamento'+clicked).value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'modifyProfesor',id:clicked,newId:newId,name:name,lastName:lastName,age:age,department:department},
    success:function(datos){
      $("#mostrardatos").html(datos);
    }
  })
  document.getElementById('form-input'+clicked).reset();
}

function modifyCarrera(clicked){
  var url="funct.php";
  var codCarrera = (document).getElementById('inputCodCarrera'+clicked).value;
  var name = (document).getElementById('inputNombreCarrera'+clicked).value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'modifyCarrera',id:clicked,codCarrera:codCarrera,name:name},
    success:function(datos){
      $("#mostrardatos").html(datos);
      //alert(datos);
    }
  })
}

function deleteProfesor(clicked){
  var url="funct.php";
  $.ajax({
      type:"post",
      url:url,
      data:{method:'deleteProfesor',id:clicked},
      success:function(datos){
        $("#mostrardatos").html(datos);
      }
  })
}

function deleteCarrera(clicked){
  var url = "funct.php";
  $.ajax({
    type:"post",
    url:url,
    data:{method:'deleteCarrera', id:clicked},
    success:function(datos){
      $("#mostrardatos").html(datos);
    }
  })
}

function addProfesor(){
  var url="funct.php";
  var rut = (document).getElementById('inputRut').value;
  var name = (document).getElementById('inputNombre').value;
  var lastName = (document).getElementById('inputApellido').value;
  var age = (document).getElementById('inputEdad').value;
  var department = (document).getElementById('inputDepartamento').value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'addProfesor',id:rut,name:name,lastName:lastName,age:age,department:department},
    success:function(datos){
      $("#mostrardatos").html(datos);
    }
  })
  document.getElementById('form-add').reset();
}

function addCarrera(){
  var url = "funct.php";
  var id = (document).getElementById('inputCodCarrera').value;
  var name = (document).getElementById('inputNombreCarrera').value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'addCarrera',id:id,name:name},
    success:function(datos){
      $("#mostrardatos").html(datos);
    }
  })
  document.getElementById('form-add').reset();
}

function loadProfesor()
{
  var url = "funct.php";
  var buscado = (document).getElementById('input').value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:"loadProfesor",id:buscado},
    success:function(datos){
      $("#main-table").html(datos);
    }
  })
}

function loadCarrera()
{
  var url = "funct.php";
  var buscado = (document).getElementById('inputCarrera').value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:"loadCarrera",id:buscado},
    success:function(datos){
      $("#main-table-carrera").html(datos);
    }
  })
}

function loadAlumno()
{
  var url = "funct.php";
  var buscado = (document).getElementById('inputRutAlumno').value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:"loadAlumno", id:buscado},
    success:function(datos){
      //alert(datos);
      $("#main-table-alumno").html(datos);
    }
  })
}

function verAlumno(clicked)
{
  var url = "funct.php";
  var page = "student.php";
  $.ajax({
    type:"post",
    url:url,
    data:{method:'verAlumno',codCarrera:clicked, page:page},
    success:function(datos){
      //alert(datos);
      $("#mostrardatos").html(datos);
    }
  })
}

function modifyAlumno(clicked){
  var url = "funct.php";
  var newId = (document).getElementById('inputMatricula'+clicked).value;
  var name = (document).getElementById('inputNombreAlumno'+clicked).value;
  var career = (document).getElementById('inputCarreraPertenece'+clicked).value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'modifyAlumno',id:clicked,newId:newId,name:name, career:career},
    success:function(datos){
      //alert(datos);
      $("#mostrardatos").html(datos);
    }
  })
}

function deleteAlumno(clicked){
  var url = "funct.php";
  $.ajax({
    type:"post",
    url:url,
    data:{method:'deleteAlumno', id:clicked},
    success:function(datos){
      //alert(datos);
      $("#mostrardatos").html(datos);
    }
  })
}

function addAlumno(){
  var url = "funct.php";
  var id = (document).getElementById('inputMatricula').value;
  var name = (document).getElementById('inputNombreAlumno').value;
  //var career = (document).getElementById('inputCarreraPertenece').value;

  $.ajax({
    type:"post",
    url:url,
    data:{method:'addAlumno',id:id,name:name},
    success:function(datos){
      //alert(datos);
      $("#mostrardatos").html(datos);
    }
  })
  document.getElementById('form-add').reset();
}
