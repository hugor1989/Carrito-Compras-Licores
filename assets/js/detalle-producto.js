const $titulo = document.querySelector("#title_product"),
    $precio = document.querySelector("#precio"),
    $desc_product = document.querySelector("#desc_product"),
    $sku = document.querySelector("#sku"),
    $categoria = document.querySelector("#categoria"),
    $btnGuardar = document.querySelector("#btnGuardar");
const idcosto = $("#tipocosto").val();

// Una global para establecerla al rellenar el formulario y leerla al enviarlo
let idProducto;

const rellenarFormulario = async () => {

    // https://parzibyte.me/blog/2020/08/14/extraer-parametros-url-javascript/
    const urlSearchParams = new URLSearchParams(window.location.search);
    idProducto = urlSearchParams.get("id"); // <-- Actualizar el ID global
    //console.log(idProducto);

    // Obtener el producto desde PHP
    
    let ajax = {
        method: "obtenerproducto_detalleId",
        Id:idProducto
    }
    
    $.ajax({
        url: 'global/sp_registro.php',
        type: "POST",
        data: ajax,
        success: function(response, textStatus, jqXHR)
        {
           
           // console.log(response);   
            $respuesta = JSON.parse(response);
            if($respuesta['status'] == true){
    
                
                console.log($respuesta['data']);

                var precio = "" ;
                        if( idcosto == 1){

                            $precio.value = $respuesta['data'].pro_preciooro;

                        }else if(idcosto == 2){

                            $precio.value = $respuesta['data'].pro_preciopremium;

                        }else if(idcosto == 3){

                            $precio.value = $respuesta['data'].pro_precioplatino;
                        }else{
                            $precio.value = "" 
                        }



                $("#title_product").html($respuesta['data'].pro_nombreproducto);
                //$titulo.value = ;
                 
                $desc_product.value = $respuesta['data'].pro_descripcion;
                $sku.value = $respuesta['data'].pro_sku;
                $categoria.value = $respuesta['data'].pro_marca;

             
            
            }
        },
        error: function (request, textStatus, errorThrown) {
            return response.json()
        }
    });
/*     const respuestaRaw = await fetch(`./obtener_producto_por_id.php?id=${idProducto}`);
    const producto = await respuestaRaw.json();
    // Rellenar formulario
    $nombre.value = producto.nombre;
    $descripcion.value = producto.descripcion;
    $precio.value = producto.precio; */
};

// Al incluir este script, llamar a la función inmediatamente
rellenarFormulario();