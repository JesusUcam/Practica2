function modificarUsuario(usuario) {
  $('#nuevo').hide();
  $('#contenido').show();
  usuario = usuario.replace('@', '\\@'); // Escapa el carácter @
  $.ajax({
      type:'POST',
      data:{
        accion:"modificarUsuario",
          email:$("#email" + usuario).val(),
          nombre:$("#nombre" + usuario).val(),
          apellidos: $("#apellidos" + usuario).val(),
          clave: $("#clave" + usuario).val()
      },
      url: "controlador/usuarios_controlador.php",
      success: function (response) {
          $("#contenido").html(response);
          console.log(response);
      },
      error: function (error) {
          console.log(error);
      },
  });
}

function setupSelect(){
  
  let la = document.getElementById('listaautores').value
  arrayFinal = la.split(", ");

  console.log(document.getElementById('autor2'));
  arrayFinal.forEach(function (email) {
    document.getElementById('autor2').innerHTML += `<option value='${email}'>${email}</option>`;
  });

}

function modificarTarea(tarea) {

  $("#nuevo").hide();
  $("#contenido").show();
  $.ajax({
    type: "POST",
    data: {
      accion: "modificarTarea",
      nombre: $("#nombre" + tarea).val(),
      descripcion: $("#descripcion" + tarea).val(),
      estado: $("#estado" + tarea).val(),
      fecha_creacion: $("#fecha_creacion" + tarea).val(),
      autor: $("#autor" + tarea).val(),
    },
    url: "controlador/tareas_controlador.php",
    success: function (response) {
      $("#contenido").html(response);
      setupSelect();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

  function cancelar() {
    $("#nuevo").show();
    $("#contenido").hide();
  }
