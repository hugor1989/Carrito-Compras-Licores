window.addEventListener('load', function() {
    const idcosto = $("#tipocosto").val();
    let ajax = {
        method: "list_pruductosindex"
    }
    
    $.ajax({
        url: 'global/sp_registro.php',
        type: "POST",
        data: ajax,
        success: function(response, textStatus, jqXHR)
        {
            var container = document.getElementById("container_inicio");
            var content=``; 
           console.log(response);   
            $respuesta = JSON.parse(response);
            if($respuesta['status'] == true){
    
                
                console.log(idcosto);

                if ($respuesta['data'].length > 0) {


                    $.each($respuesta['data'], function (key, value) {

                        var precio = "" ;
                        if( idcosto == 1){

                            precio = "$" + value.pro_preciooro;

                        }else if(idcosto == 2){

                            precio = "$" + value.pro_preciopremium;

                        }else if(idcosto == 3){

                            precio = "$" +  value.pro_precioplatino;
                        }else{
                            precio = "" 
                        }

                        var linkdetalle = "detalle-producto.php?pro_idProducto="+value.pro_idProducto;

                        content += ` <div class="col-lg-3 col-md-4 col-6">
                                            <div class="product">
                                                <div class="product_img">
                                                    <a href="shop-product-detail.html">
                                                        <img src="plataforma/${value.pro_imagen}" alt="product_img1">
                                                    </a>
                                                        <div class="product_action_box">
                                                                <ul class="list_none pr_action_btn">
                                                                    <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                                                </ul>
                                                        </div>
                                                </div>
                                                <div class="product_info">
                                                            <h6 class="product_title"><a href=${linkdetalle} >${value.pro_nombreproducto}</a></h6>
                                                            <div class="product_price">
                                                                <span class="price"> ${precio}</span>
                                                            </div>
                                                           
                                                            <div class="pr_desc">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                                            </div>
                                                            <div class="pr_switch_wrap">
                                                                <div class="product_color_switch">
                                                                    <span class="active" data-color="#87554B"></span>
                                                                    <span data-color="#333333"></span>
                                                                    <span data-color="#DA323F"></span>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>`
                        
                    });
                    //content += `</div><div class="row"></div>`
                    container.innerHTML += content;
                }
            
            }
        },
        error: function (request, textStatus, errorThrown) {
            return response.json()
        }
    });
});
