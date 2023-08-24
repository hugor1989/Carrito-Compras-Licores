const mymodal = new bootstrap.Modal('#verificar-popup');

document.querySelector('.btn-close').addEventListener('click',() => {

    Swal.fire({
        type:'warning',
        title:'Esta seguro de cerrar la venta?',
        text: 'Si cierra la ventana su verificación de cuenta no se realizará y no se podrá dar seguimiento a su alta!' ,
        confirmButtonColor:'#3085d6',
        confirmButtonText:'Aceptar'
    }).then((result) => {
        if(result.value){
            mymodal.hide();
            window.location.href = "login.php";
        }
    })

    mymodal.hide();

});

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {

    
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("step");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Crear Cuenta";
    } else {
        document.getElementById("nextBtn").innerHTML = "Siguiente";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("step");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:

        var nombre = $("#name").val();
        var usuario = $.trim($("#Nombre").val());
        var apellido = $.trim($("#Apellido").val());
        var telefono = $.trim($("#Telefono").val());
        var email = $.trim($("#Email").val());
        var pass = $.trim($("#password").val());

        Swal.fire({
            title: "Favor de confirmar información",
            html: ' <p>Negocio: <strong>' + nombre + '</strong>.</p> ' +
                  ' <p>Nombre: <strong>' + usuario + ' ' + apellido + '</strong>.</p>' +
                  ' <p>Teléfono: <strong>' + telefono + '</strong>.</p>' +
                  ' <p>Email: <strong>' + email + '</strong>.</p>' +
                  ' <p>Password: <strong>' + pass + '</strong>.</p>' ,
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-primary",
            confirmButtonText: "Guardar",
            closeOnConfirm: false,
            showLoaderOnConfirm: false
        }).then((result) =>{
            if(result.value){
                 
                 // Variables de los controles para mandar en la funcion de insertar
                 var nombreinsert = $("#name").val();
                 var usuarioinsert = $.trim($("#Nombre").val());
                 var apellidoinsert = $.trim($("#Apellido").val());
                 var telefonoinsert = $.trim($("#Telefono").val());
                 var emailinsert = $.trim($("#Email").val());
                 var passinsert = $.trim($("#password").val());
                 
                let ajax = {
                    method: "new_registro",
                    Negocio: nombreinsert,
                    Nombre: usuarioinsert,
                    Apellido: apellidoinsert,
                    Telefono: telefonoinsert,
                    Email:emailinsert,
                    Password:passinsert
                }
                $.ajax({
                    url: 'global/sp_registro.php',
                    type: "POST",
                    data: ajax,
                    success: function(data, textStatus, jqXHR)
                    {
                        //console.log(data);
                        $resp = JSON.parse(data);
                        if($resp['status'] == true){

                            $("#emailusuario").val(emailinsert);
                            setTimeout(function() {
                                $("#verificar-popup").modal('show', {}, 500);
                            }, 3000);
                            
                        
                        }else{
                             Swal("Error save customer : "+$resp['message'])
                        }
                    },
                    error: function (request, textStatus, errorThrown) {
                        Swal("Error ", request.responseJSON.message, "error");
                    }
                });
            }
        })
        
       
    }else{

        showTab(currentTab);
    }
    // Otherwise, display the correct tab:
    
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("step");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("stepIndicator");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}


jQuery(function ($) {
    $('[id^=Btn_VerificarCodigo]').on('click', function (e) {
        e.preventDefault();


        $("#verificar-popup").modal('hide', {}, 500);

        var emailinsert = $("#emailusuario").val();
        var codigo = $.trim($("#codigo").val());

        let ajax = {
            method: "verificar_cuenta",
            Codigo: codigo,
            Email: emailinsert,
           
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
                            title:'Verificacion de cuenta correcta!',
                            text: 'Favor de seguir con las instrucciones para la activación de la cuenta!' ,
                            confirmButtonColor:'#3085d6',
                            confirmButtonText:'Aceptar'
                        }).then((result) => {
                            if(result.value){
                                window.location.href = "index.php";
                            }
                        })
                    
                    }else{

                        Swal.fire({
                            type:'warning',
                            title:'Verificación de correo electrónico incorrecta!',
                            text: 'Favor de ingresar el codigo correcto! ' +  $respuesta['message'],
                            confirmButtonColor:'#3085d6',
                            confirmButtonText:'Aceptar'
                        }).then((result) => {
                            if(result.value){
                                $("#verificar-popup").modal('show', {}, 500);
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


      // funcion para validar que el email no este registrado en otro usuario
function validaUsuario() {
    var email=$('#Email').val();


    let ajax = {
        method: "verificar_email",
        Email: email,
       
    }

    $.ajax({
        url: 'global/sp_registro.php',
        type: "POST",
        data: ajax,
        success: function(response, textStatus, jqXHR)
        {
           //console.log(response);
            $respuesta = JSON.parse(response);
           // console.log(response);
            if($respuesta['status'] == true){

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });

                  $(document).ready(function() {
                    Toast.fire({
                      icon: 'error',
                      title: 'El correo ingresado ya existe, intentar con otro diferente'
                    })
                  });
                  $('#nextBtn').hide('hide');
             
            }else{

                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                  });

                  $(document).ready(function() {
                    Toast.fire({
                      icon: 'success',
                      title: 'El correo electrónico de usuario es válido'
                    })
                  });
            }
        },
        error: function (request, textStatus, errorThrown) {
            return response.json()
        }
    });
   
}