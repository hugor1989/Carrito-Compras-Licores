const mymodal = new bootstrap.Modal('#verificar-popup');

document.querySelector('.btn-close').addEventListener('click',() => {

    Swal.fire({
        type:'warning',
        title:'Estar seguro de cerrar la venta?',
        text: 'Si cierra la ventana su verificacion de cuenta no se realizara y no se podra dar seguimiento a su alta!' ,
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

jQuery(function ($) {
    $('[id^=login]').on('click', function (e) {
        e.preventDefault();

        var email = $("#email").val();
        var password = $("#password").val();

        console.log(email);
        console.log(password);

        let ajax = {
            method: "iniciar_sesion",
            Email: email,
            Password: password,
           
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
                            title:$respuesta['message'],
                            text: 'Bienvenido a tu espacio ' + $respuesta['usuario'] ,
                            confirmButtonColor:'#3085d6',
                            confirmButtonText:'Aceptar'
                        }).then((result) => {
                            if(result.value){
                                window.location.href = "index.php";
                            }
                        })
                    
                    }else if ($respuesta['status'] == false){

                        if($respuesta['verificacion'] == 0){

                            Swal.fire({
                                type:'warning',
                                title:'Inicio de session no realizado',
                                text: $respuesta['message'],
                                confirmButtonColor:'#3085d6',
                                confirmButtonText:'Aceptar'
                            }).then((result) => {
                                if(result.value){
                                    $("#emailusuario").val(email);
                                    $("#verificar-popup").modal('show', {}, 500);
                                }
                            })

                        }else if ($respuesta['verificacion'] == null){

                            Swal.fire({
                                type:'info',
                                title:'Inicio de session no realizado',
                                text: $respuesta['message'],
                                confirmButtonColor:'#3085d6',
                                confirmButtonText:'Aceptar'
                            }).then((result) => {
                                if(result.value){
                                    //$("#verificar-popup").modal('show', {}, 500);
                                }
                            })
                        }
                       
                    }
                },
                error: function (request, textStatus, errorThrown) {
                    return response.json()
                }
            });

        });
});

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
                            text: 'Favor de seguir con las instrucciones para la activacion de la cuenta!' ,
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
                            title:'Verificacion de email incorrecta!',
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