//$('.btnElegirColumnas').on('click', function(event){
//    event.preventDefault();

//})
var checkBox = $(".seleccionarColumna");
/*=============================================
VALIDAR EL INGRESO DE NOMBRE DE TABLA Y CAMPOS DE TABLA
=============================================*/
function registroTabla(){

  if ($('.seleccionarColumna').prop('checked') ) {

    $(this).attr("valorExc", $(this).attr("colum"));

    crearDatosJsonColumna();

  }else{

    $(this).attr("valorExc","");

    crearDatosJsonColumna();

  }

  /*=============================================
  VALIDAR EL NOMBRE DE LA TABLA
  =============================================*/
   var nombre = $("#nombreTabla").val();

   if(nombre != ""){

     var expresion = /^[a-zA-Z0-9ñÑáéióúÁÉÍÓÚ_]*$/;

     if(!expresion.test(nombre)){

       $("#nombreTabla").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten espacios ni caracteres especiales</div>')
      return false;

     }

   }else{

     $("#nombreTabla").parent().before('<div class="alert alert-warning"><strong>ATENCION:</strong> Este campo es obligatorio</div>')
    return false;

   }


  return true;
}


$('.excelarch').on('change',function(){
  var ext = $(this).val().split('.').pop();
  if ($(this).val() != '') {
    if (ext == "xls" || ext == "xlsx" || ext == "csv") {

    } else{
      $(this).val('');
      swal({
         title: "Mensaje de Error",
         text: "Extension no permitida:" +ext,
         type: "error",
         confirmButtonText: "¡Cerrar!"
       });
    }
  }
});

$('#cargar_excel_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
    url:"ajax/cabeceraexcel.ajax.php",
    method:"POST",
    data:new FormData(this),
    contentType:false,
    cache:false,
    processData:false,
    success:function(data)
    {

      if(data == "ok"){

        swal({
       title: "¡Archivo cargado con exito!",
       type: "success",
       confirmButtonText: "¡Cerrar!"
             }).then(function(result) {
                 if (result.value) {

                   window.location = "importexcel";

                 }
           });

      }



    }
  })
});


$(".seleccionarColumna").on("ifChecked",function(){

	$(this).attr("valorExc", $(this).attr("colum"));

	crearDatosJsonColumna();

});

$(".seleccionarColumna").on("ifUnchecked",function(){

	$(this).attr("valorExc","");

	crearDatosJsonColumna();

})

function crearDatosJsonColumna(){

  var columnaExcel = [];

  for(var i = 0; i < checkBox.length; i++){

    if($(checkBox[i]).attr("valorExc") != ""){

      columnaExcel.push({"columna": $(checkBox[i]).attr("colum"),
                         "activo": 1,
                         "nombre": $(checkBox[i]).attr("nombre")})

       console.log(columnaExcel);


    }else{

      columnaExcel.push({"columna": $(checkBox[i]).attr("colum"),
                         "activo": 0,
                         "nombre": $(checkBox[i]).attr("nombre")})

                         console.log(columnaExcel);

    }

    $("#valorExcel").val(JSON.stringify(columnaExcel));

  }

}
