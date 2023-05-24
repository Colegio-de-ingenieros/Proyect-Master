$('input[type="file"]').on('change', function(){
    var ext = $( this ).val().split('.').pop();
    if ($( this ).val() != '') {
      if(ext == "pdf"){
        if($(this)[0].files[0].size > 3048576){
          alert("El archivo seleccionado supera el tamaño máximo permitido de 3MB");
          $(this)[0].value = ""; // Limpia el valor del campo de archivo
          $('#modal-title').text('¡Precaución!');
          $('#modal-msg').html("Se solicita un archivo no mayor a 3MB. Por favor verifica.");
          $("#modal-gral").modal();           
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