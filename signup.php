<?php 
require_once ("head.php");
?>


<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Registrar Cuenta</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Registrar Cuenta</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Crear Cuenta</h3>
                        </div>
                        <form id="signUpForm" action="" method="post">
                                <!-- start step indicators -->
                                <div class="form-header d-flex mb-4">
                                    <span class="stepIndicator">Nombre de Negocio</span>
                                    <span class="stepIndicator">Informacion Comercial</span>
                                    <!-- <span class="stepIndicator">Personal Details</span> -->
                                </div>
                                <!-- end step indicators -->
                            
                                <!-- step one -->
                                <div class="step">
                                    <p class="text-center mb-4">Nombre Comercial</p>
                                    <div class="mb-3">
                                        <input type="text" required="" class="form-control" id="name" name="name" placeholder="Ingresar Nombre">
                                    </div>
                                </div>
                            
                                <!-- step two -->
                                <div class="step">
                                    <p class="text-center mb-4">Informacion de Contacto</p>
                                    <div class="mb-3">
                                        <input type="text" placeholder="Nombre" oninput="this.className = ''" name="Nombre" id="Nombre">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" placeholder="Apellido" oninput="this.className = ''" name="Apellido" id="Apellido">
                                    </div>
                                    <div class="mb-3">
                                    
                                        <input type="numeric" maxlength="10"
                                               oninput="this.className = ''" name="Telefono" id="Telefono" 
                                               placeholder="xx-xxxx-xxxx">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" placeholder="Email" oninput="this.className = ''" name="Email" id="Email"  onchange="validaUsuario()">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" placeholder="Puesto" oninput="this.className = ''" name="Puesto" id="Puesto">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input class="form-control" required="" type="password" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group mb-3">
                                        <input class="form-control" required="" type="password" name="renewpassword" placeholder="Confirmar Password">
                                    </div>
                                    
                                </div>
                            
                                <div class="form-footer d-flex">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Regresar</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>
                                </div>
                                <!-- end previous / next buttons -->
                            </form>
                  
                        <div class="form-note text-center">Ya tienes cuenta? <a href="login.php">Inicia Sesion</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END LOGIN SECTION -->

<!-- START SECTION SUBSCRIBE NEWSLETTER -->
<div class="section bg_default small_pt small_pb">
	<div class="container">	
    	<div class="row align-items-center">	
            <div class="col-md-6">
                <div class="heading_s1 mb-md-0 heading_light">
                    <h3>Subscribe Our Newsletter</h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="newsletter_form">
                    <form>
                        <input type="text" required="" class="form-control rounded-0" placeholder="Enter Email Address">
                        <button type="submit" class="btn btn-dark rounded-0" name="submit" value="Submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- START SECTION SUBSCRIBE NEWSLETTER -->

</div>
<!-- END MAIN CONTENT -->
<!-- END MAIN CONTENT -->
<!-- Home Popup Section -->
<div class="modal fade subscribe_popup" id="verificar-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row g-0">
                    
                    <div class="col-sm-12">
                        <div class="popup_content">
                            <div class="popup-text">
                                <div class="heading_s1">
                                    <h4>Verificacion de Cuenta</h4>
                                </div>
                                <p>Favor de ingresar el codigo para verificar su cuenta de email.</p>
                            </div>
                            <form method="post">
                                <input type="hidden" id="emailusuario" name="emailusuario">
                            	<div class="form-group mb-3">
                                	<input name="codigo" id="codigo" required type="text" class="form-control rounded-0" placeholder="Ingresar codigo">
                                </div>
                                <div class="form-group mb-3">
                                	<button id="Btn_VerificarCodigo" name="Btn_VerificarCodigo"
                                            class="btn btn-fill-line btn-block text-uppercase rounded-0" title="Validar" type="submit">Validar</button>
                                </div>
                            </form>
                 
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>
<!-- End Screen Load Popup Section --> 
<?php 
require_once ("footer.php");
?>

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<!-- Latest jQuery --> 
<script src="assets/js/jquery-3.6.0.min.js"></script> 
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

<script src="assets/js/funcion-form-steep.js"></script>

<script src="assets/js/funciones.js"></script>

<!-- ./sweet -->
<script src="sweetalert2/sweetalert2.all.min.js"></script>    

</body>
</html>


