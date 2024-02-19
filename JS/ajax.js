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

function modificarTarea(tarea) {
    $("#nuevo").hide();
    $("#contenido").show();
    $.ajax({
      type: "POST",
      data: {
        accion: "modificarTarea",
        titulo: $("#titulo" + tarea).val(),
        descripcion: $("#descripcion" + tarea).val(),
        estado: $("#estado" + tarea).val(),
      },
      url: "controlador/tareas_controlador.php",
      success: function (response) {
        $("#contenido").html(response);
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
