/*$(document).ready(function(){
    $('.buttonEliminar').on("click",function(){
      console.log(this.id);
    });
  });
*/

function modifyInstance(clicked){
  var url="funct.php";
  var name = (document).getElementById('inputNombre' + clicked).value;
  var lastName = (document).getElementById('inputApellido'+clicked).value;
  var age = (document).getElementById('inputEdad'+clicked).value;
  var department = (document).getElementById('inputDepartamento'+clicked).value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'modify',id:clicked,name:name,lastName:lastName,age:age,department:department},
    success:function(datos){
      $("#mostrardatos").html(datos);
    }
  })
  document.getElementById('form-input'+clicked).reset();
  /*var form = (document).getElementById('form-input'+clicked);
  var inputs = form.getElementsByTagName('input');
    for (var i = 0; i<inputs.length; i++) {
        switch (inputs[i].type) {
            // case 'hidden':
            case 'text':
                inputs[i].value = '';
                break;
            case 'radio':
            case 'checkbox':
                inputs[i].checked = false;
        }
      }*/
}

function deleteInstance(clicked){

  var url="funct.php";
  $.ajax({
      type:"post",
      url:url,
      data:{method:'delete',id:clicked},

      success:function(datos){
        $("#mostrardatos").html(datos);
      }

  })
}

function addInstance(){
  var url="funct.php";
  var rut = (document).getElementById('inputRut').value;
  var name = (document).getElementById('inputNombre').value;
  var lastName = (document).getElementById('inputApellido').value;
  var age = (document).getElementById('inputEdad').value;
  var department = (document).getElementById('inputDepartamento').value;
  $.ajax({
    type:"post",
    url:url,
    data:{method:'add',id:rut,name:name,lastName:lastName,age:age,department:department},
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
      $("#main-table").html(datos);
    }
  })
}
