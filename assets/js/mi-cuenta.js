window.addEventListener('load', function() {

    var idUsuario = $("#idUsuario").val();
    let ajax = {
        method: "list_sucursales",
        idUsuario: idUsuario
    }
    
    $.ajax({
        url: 'global/sp_registro.php',
        type: "POST",
        data: ajax,
        success: function(response, textStatus, jqXHR)
        {
            var container = document.getElementById("address");
            var content=``; 
          //  console.log(response);   
            $respuesta = JSON.parse(response);
            if($respuesta['status'] == true){
    
                

                if ($respuesta['data'].length > 0) {


                    $.each($respuesta['data'], function (key, value) {

                        if(key == 0){
                            //add start row 
                            content+= `<div class="row">`
                        }
                        content += ` <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Sucursal: ${value.suc_nombresucursal}</h3>
                                            </div>
                                        <div class="card-body">
                                            <address>Direccion:${value.suc_direccion}</address>
                                            <p>Contacto:${value.suc_contactosucursal}</p>
                                            <p>Telefono:${value.suc_telefono}</p>
                                            <p>Email:${value.suc_email}</p>
                                           
                                        </div>
                                    </div></div>`
                        
                    });
                    content += `</div><div class="row"></div>`
                    container.innerHTML += content;
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
    var code = $("#code").val();

    if(files.length > 0 ){

         var formData = new FormData();
         formData.append("file", files[0]);
         formData.append("coding",code);

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
el.innerText =  r.valueAsNumber;
r.addEventListener('change', () => {

            if( r.valueAsNumber > 20000){

                el.innerText =  new Intl.NumberFormat('es-MX').format(r.valueAsNumber.toFixed(0)) + "+" ;
            }else{

                el.innerText =  new Intl.NumberFormat('es-MX').format(r.valueAsNumber.toFixed(0)) ;
            }

            
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
        var giro = $("#giroempresa").val();
        
        
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
              //  console.log(response);
                    $respuesta = JSON.parse(response);
                // console.log(response);
                    if($respuesta['status'] == true){

                        Swal.fire({
                            type:'success',
                            title:'Actualización de perfil',
                            text: 'Información actualizada correctamente',
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

// funcion para registrar una nueva sucursal de cliente
function generarSucursal() {
    var idCliente=$('#IdCliente').val();
    var nombresucursal=$('#nombresucursal').val();
    var contactosuc=$('#contactosuc').val();
    var telefonosuc=$('#telefonosuc').val();
    var emailsuc=$('#emailsuc').val();
    var direccion=$('#direccion').val();
    var latitud=$('#latitud').val();
    var longitud=$('#longitud').val();

if (idCliente==idCliente){

    let ajax = {
        method: "agregar_sucursal",
        idCliente : idCliente,
        nombresucursal : nombresucursal,
        contactosuc : contactosuc,
        telefonosuc : telefonosuc,
        emailsuc : emailsuc,
        direccion : direccion,
        latitud : latitud,
        longitud : longitud
       
    } 
    

         $.ajax({
            url: 'global/sp_registro.php',
            type: "POST",
            data: ajax,
            success: function(response, textStatus, jqXHR)
            {
           // console.log(response);
                $respuesta = JSON.parse(response);
            // console.log(response);
                if($respuesta['status'] == true){

                    Swal.fire({
                        type:'success',
                        title:$respuesta['message'],
                        text: '',
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
                        title:$respuesta['message'],
                        text: '',
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
} else {
      var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
      });
      $(document).ready(function() {
      Toast.fire({
      icon: 'error',
      title: 'No se establecio un cliente'
      })
    });
  } 
}
