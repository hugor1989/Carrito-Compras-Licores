<?php 
require_once ("head.php");
?>




<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
        	<div class="col-md-6">
                <div class="page-title">
            		<h1>Product Detail</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Producto Detalle</li>
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
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
              <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" name="product_img" src='assets/images/product_img1.jpg' data-zoom-image="assets/images/product_zoom_img1.jpg" alt="product_img1" />
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="pr_detail">
                    <div class="product_description">
                        <h4 class="product_title" id="title_product" name="title_product"></h4>
                        <div class="product_price">
                            <span class="price" id="precio" name="precio"></span>
                            <!-- <del>$55.25</del> -->
                            <!-- <div class="on_sale">
                                <span>35% Off</span>
                            </div> -->
                        </div>
                        <div class="rating_wrap">
                               <!--  <div class="rating">
                                    <div class="product_rate" style="width:80%"></div>
                                </div>
                                <span class="rating_num">(21)</span> -->
                            </div>
                        <div class="pr_desc">
                            <p id="desc_product" name="desc_product"></p>
                        </div>
                        <div class="product_sort_info">
                            <ul>
                                <li><i class="linearicons-shield-check"></i> 1 Year AL Jazeera Brand Warranty</li>
                                <li><i class="linearicons-sync"></i> 30 Day Return Policy</li>
                                <li><i class="linearicons-bag-dollar"></i> Cash on Delivery available</li>
                            </ul>
                        </div>
                        <!-- <div class="pr_switch_wrap">
                            <span class="switch_lable">Color</span>
                            <div class="product_color_switch">
                                <span class="active" data-color="#87554B"></span>
                                <span data-color="#333333"></span>
                                <span data-color="#DA323F"></span>
                            </div>
                        </div> -->
                    </div>
                    <hr />
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="cart_btn">
                            <button class="btn btn-fill-out btn-addtocart" type="button"><i class="icon-basket-loaded"></i> Agregar a Carrito</button>
                          <!--   <a class="add_compare" href="#"><i class="icon-shuffle"></i></a>
                            <a class="add_wishlist" href="#"><i class="icon-heart"></i></a> -->
                        </div>
                    </div>
                    <hr />
                    <ul class="product-meta">
                        <li>SKU: <a href="#" id="sku" name="sku"></a></li>
                        <li>Categoria: <a href="#" id="categoria" name="categoria"></a></li>
                        <!-- <li>Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">printed</a> </li> -->
                    </ul>
                    
                    <div class="product_share">
                        <span>Share:</span>
                        <ul class="social_icons">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="large_divider clearfix"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="tab-style3">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                      	</li>
                    </ul>
                	<div class="tab-content shop_info_tab">
                      	<div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                        	<p id="descripcion" name="descripcion"></p>
                      	</div>
                	</div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="small_divider"></div>
            	<div class="divider"></div>
                <div class="medium_divider"></div>
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
<!-- scripts js --> 
<script src="assets/js/detalle-producto.js"></script>
</body>
</html>