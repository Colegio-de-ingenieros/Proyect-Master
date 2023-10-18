$('input[type="file"]').on('change', function(){
    var ext = $( this ).val().split('.').pop();
    if ($( this ).val() != '') {
      if(ext == "sql" || ext == "SQL"){
        if($(this)[0].files[0].size > 180000000){
          alert("El archivo seleccionado supera el tamaño máximo permitido de 180MB");
          $(this)[0].value = ""; // Limpia el valor del campo de archivo
          $('#modal-title').text('¡Precaución!');
          $('#modal-msg').html("Se solicita un archivo no mayor a 180MB. Por favor verifica.");
          //$("#modal-gral").modal();           
          $(this).val('');
        }else{
          $("#modal-gral").hide();
        }
      }
      else
      {
        $( this ).val('');
        alert("Extensión no permitida: " + ext);
      }
    }
  });