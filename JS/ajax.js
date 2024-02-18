function modificarTarea(tarea) {
    $("#nuevo").hide();
    $("#contenido").show();
    $.ajax({
      type: "POST",
      data: {
        accion: "modificar",
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
