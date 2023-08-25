window.addEventListener('load', function() {
    let ajax = {
        method: "list_giro"
    }
    
    $.ajax({
        url: 'global/sp_registro.php',
        type: "POST",
        data: ajax,
        success: function(response, textStatus, jqXHR)
        {
        
        $respuesta = JSON.parse(response);
            if($respuesta['status'] == true){
    
                

                if ($respuesta['data'].length > 0) {
                    $.each($respuesta['data'], function (key, value) {
                        var option = $(document.createElement('option'));
                        option.html(value.giremp_nombre);
                        option.val(value.giremp_idGiro);
                        $("#giroempresa")
                            .append(option);
                    });
                }
            
            }
        },
        error: function (request, textStatus, errorThrown) {
            return response.json()
        }
    });
});



$("#archivocsf").change(function(e) {
    //do whatever you want here

    var files = document.getElementById("archivocsf").files;

    if(files.length > 0 ){

         var formData = new FormData();
         formData.append("file", files[0]);

         var xhttp = new XMLHttpRequest();

         // Set POST method and ajax file path
         xhttp.open("POST", "upload.php", true);

         // call on request changes state
         xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {

                   var response = this.responseText;
                   if(response != ""){
                    $("#urlpdf").val(response);
                   }else{
                    $("#urlpdf").val(response);
                   }
              }
         };

         // Send request with data
         xhttp.send(formData);

    }else{
         alert("Please select a file");
    }
});


var el = document.getElementById('curr');
        var r = document.getElementById('myRange');
        el.innerText = r.valueAsNumber;
        r.addEventListener('change', () => {
            el.innerText = r.valueAsNumber;
            $("#credito").val(r.valueAsNumber);
        })


jQuery(function ($) {
    $('[id^=Btn_actualizarinformacionusuario]').on('click', function (e) {
        e.preventDefault();

        var idUsuario = $("#idUsuario").val();
        var nosucursales = $("#nosucursales").val();
        var ticket = $("#ticket").val();
        var nomesas = $("#nomesas").val();
        var noempleados = $("#noempleados").val();
        var files = $("#urlpdf").val();;
        var plazopago = $("#plazopago").val();
        var price_filter = $("#credito").val();
        
        
        
        var nameref1 = $("#nameref1").val();
        var telref1 = $("#telref1").val();
        var dirref1 = $("#dirref1").val();
        var comment1 = $("#comment1").val();

        var nameref2 = $("#nameref2").val();
        var telref2 = $("#telref2").val();
        var dirref2 = $("#dirref2").val();
        var comment2 = $("#comment2").val();
        
       

        let ajax = {
            method: "actualizar_perfil",
             idUsuario : idUsuario,
             nosucursales : nosucursales,
             ticket : ticket,
             nomesas : nomesas,
             noempleados : noempleados,
             files : files,
             plazopago : plazopago,
             price_filter : price_filter,
             nameref1 : nameref1,
             telref1 : telref1,
             dirref1 : dirref1,
             comment1 : comment1,
             nameref2 : nameref2,
             telref2 : telref2,
             dirref2 : dirref2,
             comment2 : comment2,
             giro : giro
           
        } 
        

             $.ajax({
                url: 'global/sp_registro.php',
                type: "POST",
                data: ajax,
                success: function(response, textStatus, jqXHR)
                {
                console.log(response);
                    $respuesta = JSON.parse(response);
                // console.log(response);
                    if($respuesta['status'] == true){

                        Swal.fire({
                            type:'success',
                            title:'Actualización de perfil',
                            text: $respuesta['message'],
                            confirmButtonColor:'#3085d6',
                            confirmButtonText:'Aceptar'
                        }).then((result) => {
                            if(result.value){
                                window.location.href = "mi-cuenta.php";
                            }
                        })
                    
                    }else if ($respuesta['status'] == false){

                        Swal.fire({
                            type:'info',
                            title:'Actualización de perfil',
                            text: $respuesta['message'],
                            confirmButtonColor:'#3085d6',
                            confirmButtonText:'Aceptar'
                        }).then((result) => {
                            if(result.value){
                                //$("#verificar-popup").modal('show', {}, 500);
                            }
                        })
                       
                    }
                },
                error: function (request, textStatus, errorThrown) {
                    return response.json()
                }
            }); 

        });
});
$(function () {

    // console.log(password);

   /* let ajax = {
        method: "obtener_informacion_usuario",
        Email: email,
        Password: password,
       
    }

	$.ajax({

        url: 'global/sp_registro.php',
		method: "POST",
		data: ajax,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			//console.log(respuesta["Id"]);
			$("#editarDescripcion").val(respuesta["Descripcion"]);
			$("#editarRFC").val(respuesta["RFC"]);
			$("#editarCuotaBasica").val(respuesta["VT"]);
			$("#editarCuota_Rot").val(respuesta["Cuota_Rot"]);
			$("#editarCuota_TR").val(respuesta["Cuota_TR"]);
			$("#editarCuota_Contenedor").val(respuesta["Cuota_Contenedor"]);
			$("#editarTelefono").val(respuesta["Telefono"]);
			$("#editarDireccion").val(respuesta["Direccion"]);
			$("#editarPoliza").val(respuesta["NumeroPoliza"]);
			$("#id").val(respuesta["Id"]);

			//Aqui valido la url de la imagen que no venga vacia, si viene vacia, no cambio, si viene muestro imagen
			if(respuesta["CondicionesGenerales"] != ""){

				$("#rutaactualpdf").val(respuesta["CondicionesGenerales"]);
			}
			
			//Aqui valido la url de la imagen que no venga vacia, si viene vacia, no cambio, si viene muestro imagen
			if(respuesta["Logo"] != ""){

				$("#rutaactual").val(respuesta["Logo"]);

				var baseStr64 = respuesta["Logo"];
				img_tag_id.setAttribute('src', "data:image/jpg;base64," + baseStr64);
				//$("#img_tag_id").attr('src', 'data:image/*;base64,' + respuesta["Logo"]);
				//$("#img_tag_id").attr("src",respuesta["Logo"])
			}
			
		}

	}); */
});
