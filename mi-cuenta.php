<?php 
require_once ("head.php");
?>
<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Mi Cuenta</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Mi Cuenta</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section">
	<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="dashboard_menu">
                    <ul class="nav nav-tabs flex-column" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Pedido</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>Mis Direcciones</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Detalle Cuenta</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="salir.php"><i class="ti-lock"></i>Cerrar Session</a>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="tab-content dashboard_content">
                  	<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    	<div class="card">
                        	<div class="card-header">
                                <h3>Dashboard</h3>
                            </div>
                            <div class="card-body">
                                
                                <?php if($_SESSION['status'] == 1) { ?>

                                    <p>Favor de terminar el registro de tu informacion, dirigete a la seccion de Detalle Cuenta, para finalizar tu registro de informacion</a></p>
                                <?php }else{ ?>

                                    <p>Desde el panel de tu cuenta. puede verificar y ver fácilmente sus pedidos recientes, administrar sus direcciones de envío y facturación y editar su contraseña y los detalles de su cuenta</p>

                                <?php } ?> 
                            </div>
                        </div>
                  	</div>
                  	<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    	<div class="card">
                        	<div class="card-header">
                                <h3>Orders</h3>
                            </div>
                            <div class="card-body">
                    			<div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#1234</td>
                                                <td>March 15, 2020</td>
                                                <td>Processing</td>
                                                <td>$78.00 for 1 item</td>
                                                <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>#2366</td>
                                                <td>June 20, 2020</td>
                                                <td>Completed</td>
                                                <td>$81.00 for 1 item</td>
                                                <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                  	</div>
					<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                    	<div class="row">
                        	<div class="col-lg-6">
                                <div class="card mb-3 mb-lg-0">
                                    <div class="card-header">
                                        <h3>Billing Address</h3>
                                    </div>
                                    <div class="card-body">
                                        <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212</address>
                                        <p>New York</p>
                                        <a href="#" class="btn btn-fill-out">Edit</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Shipping Address</h3>
                                    </div>
                                    <div class="card-body">
                                        <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212</address>
                                        <p>New York</p>
                                        <a href="#" class="btn btn-fill-out">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
						<div class="card">
                        	<div class="card-header">
                                <h3>Detalle de la Cuenta</h3>
                            </div>
                            <div class="card-body">
                    			
                                <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre del negocio</label>
                                        <input type="text" class="form-control" id="nombrenegocio" name="nombrenegocio" value="<?php echo $_SESSION['negocio']; ?>" readonly>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contacto</label>
                                        <input type="text" class="form-control" id="nombrecompletousr" name="nombrecompletousr" value="<?php echo $_SESSION['nombre']; ?>" readonly>
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Número de Sucursales</label>
                                        <input type="text" class="form-control" id="nosucursales" name="nosucursales" placeholder="Cuantas sucursales tienes?">
                                        <input type="hidden" class="form-control" id="activarRegistro" name="activarRegistro" value="activarRegistro">
                                        <input type="hidden" class="form-control" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['Id']; ?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ticket promedio</label>
                                        <input type="text" class="form-control" id="ticket" name="ticket" placeholder="Ticket promedio">
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Número de mesas</label>
                                        <input type="text" class="form-control" id="nomesas" name="nomesas" placeholder="Número de mesas por todas las sucursales">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Número de empleados</label>
                                        <input type="text" class="form-control" id="noempleados" name="noempleados" placeholder="Número total de empleados por todas las sucursales">
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Constancia de Situación Fiscal (PDF)</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="hidden" id="urlpdf" name="urlpdf">
                                                        <input class="custom-file-input" type="file" id="archivocsf" name="archivocsf" accept=".pdf" required>
                                                    </div>
                                                </div> 
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Plazo de pago en días</label>
                                        <input type="text" class="form-control" id="plazopago" name="plazopago" value="7" readonly placeholder="Dias de credito del cliente">
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="widget">
                                                <h5 class="widget_title">Monto a autorizar de crédito</h5>
                                                <div class="filter_price">
                                                    <div id="price_filter" name="price_filter" data-min="0" data-max="50000" data-min-value="50" data-max-value="50000" data-price-sign="$"></div>
                                                    <div class="price_range">
                                                        <span>Credito: <span id="flt_price"></span></span>
                                                        <input type="hidden" id="price_first">
                                                        <input type="hidden" id="price_second">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>        
                                <div class="row">
                                    <legend>Referencias comerciales de la Empresa</legend>
                                    <div class="col-md-12"> 
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dynamic_field3">
                                                <tr>
                                                    <td><b>Proveedor</b></td>
                                                    <td><b>Teléfono</b></td>
                                                    <td><b>Dirección</b></td>
                                                    <td><b>Comentarios</b></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="nameref1" name="nameref1" placeholder="Nombre comercial del proveedor"></td>
                                                    <td><input type="text" class="form-control" id="telref1" name="telref1" placeholder="Teléfono de contacto"></td>
                                                    <td><input type="text" class="form-control" id="dirref1" name="dirref1" placeholder="Dirección (Incluye calle, colonia, estado y municipio)"></td>
                                                    <td><input type="text" class="form-control" id="comment1" name="comment1"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="nameref2" name="nameref2" placeholder="Nombre comercial del proveedor"></td>
                                                    <td><input type="text" class="form-control" id="telref2" name="telref2" placeholder="Teléfono de contacto"></td>
                                                    <td><input type="text" class="form-control" id="dirref2" name="dirref2" placeholder="Dirección (Incluye calle, colonia, estado y municipio)"></td>
                                                    <td><input type="text" class="form-control" id="comment2" name="comment2"></td>
                                                </tr>
                                                </table>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-fill-out" id="Btn_actualizarinformacionusuario" name="Btn_actualizarinformacionusuario" value="Submit">Actualizar Infotrmacion</button>
                                </div>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END SECTION SHOP -->


</div>
<!-- END MAIN CONTENT -->

<!-- START FOOTER -->
<?php 
require_once ("footer.php");
?>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<!-- Latest jQuery --> 
<script src="assets/js/jquery-3.6.0.min.js"></script> 
<!-- jquery-ui --> 
<script src="assets/js/jquery-ui.js"></script>
<!-- popper min js -->
<script src="assets/js/popper.min.js"></script>
<!-- Latest compiled and minified Bootstrap --> 
<script src="assets/bootstrap/js/bootstrap.min.js"></script> 
<!-- owl-carousel min js  --> 
<script src="assets/owlcarousel/js/owl.carousel.min.js"></script> 
<!-- magnific-popup min js  --> 
<script src="assets/js/magnific-popup.min.js"></script> 
<!-- waypoints min js  --> 
<script src="assets/js/waypoints.min.js"></script> 
<!-- parallax js  --> 
<script src="assets/js/parallax.js"></script> 
<!-- countdown js  --> 
<script src="assets/js/jquery.countdown.min.js"></script> 
<!-- imagesloaded js --> 
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<!-- isotope min js --> 
<script src="assets/js/isotope.min.js"></script>
<!-- jquery.dd.min js -->
<script src="assets/js/jquery.dd.min.js"></script>
<!-- slick js -->
<script src="assets/js/slick.min.js"></script>
<!-- elevatezoom js -->
<script src="assets/js/jquery.elevatezoom.js"></script>
<!-- scripts js --> 
<script src="assets/js/scripts.js"></script>

<script src="assets/js/mi-cuenta.js"></script>

<!-- ./sweet -->
<script src="sweetalert2/sweetalert2.all.min.js"></script>    

</body>
</html>