<?php 
    $logoSrc = "";

    if(substr_count($_SERVER["REQUEST_URI"], "/") == 3){
        $logoSrc = "../assets/images/logo-invertida.png";
    }
    else{
        $logoSrc = "assets/images/logo-invertida.png";
    }
?>

<footer class="footer pt-2 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 hb-order-0">
                <img 
                    src="<?php echo $logoSrc; ?>" 
                    class="mb-3"
                />
            </div>
            <div class="col-sm-12 col-md-4 pt-2 hb-order-1">
                <h6 class="hb-txt-secondary hb-w-700">
                    CONTATO
                </h6>
                <div>
                    <a 
                        href="mailto:contatohouseofbarber@gmail.com" 
                        class="hb-txt-white hb-d-block hb-w-400 mt-3 mb-3" id="email"
                    >
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span class="ml-1">
                            contatohouseofbarber@gmail.com
                        </span>
                    </a>
                    <a href="#" class="hb-txt-white hb-w-400 mt-2">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span class="ml-1">(XX) XXXXX-XXXX</span>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 pt-3 hb-order-2">
                <h6 class="hb-txt-secondary hb-w-700">
                    REDES SOCIAIS
                </h6>
                <div>
                    <div class="social-midia mt-3 mb-3">
                        <a href="#" class="hb-color-white text-decoration-none mr-1 ml-1">
                            <button class="hb-btn-social-midia ">
                                <i class="fa fa-facebook d-flex align-items-center justify-content-center"></i>   
                            </button>
                        </a>
                        <a href="#" class="hb-color-white text-decoration-none mr-1 ml-1">
                            <button class="hb-btn-social-midia">
                                <i class="fa fa-instagram d-flex align-items-center justify-content-center"></i>  
                            </button>
                        </a>
                        <a href="#" class="hb-color-white text-decoration-none mr-1 ml-1">
                            <button class="hb-btn-social-midia">
                                <i class="fa fa-whatsapp d-flex align-items-center justify-content-center"></i>  
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>