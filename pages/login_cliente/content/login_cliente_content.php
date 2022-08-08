<section class="login hb-bg-black hb-content">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 align-self-center text-center" id="banner-login">
                <img src="../assets/images/back-login.jpg" alt="login" id="img-login">
            </div>
            <div class="col-md-5 col-sm-12 align-self-center mt-4 mb-4">
                <div class="card hb-card mb-3">
                    <div class="card-body">
                        <form class="pt-3" id="login_cliente" method="post">
                            <!-- campo de email -->
                            <div class="form-group icone_dentro_input">
                                <!-- O atributo onkeyup juntamente com a expressão regular impede que o espaços sejam digitados neste campo -->
                                <input 
                                    onkeyup="this.value=this.value.replace(/[' ' çÇáÁàÀéèÉÈíìÍÌóòÓÒúùÚÙñÑ~&´`^{}[º$()\']/g,'')" 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="email" 
                                    placeholder="E-mail"
                                    name="email_input"
                                >
                                <ion-icon name="mail-outline" id="icone_email">
                                </ion-icon>
                            </div>

                            <!-- campo de senha -->
                            <div class="form-group icone_dentro_input">
                                <!-- O atributo onkeyup juntamente com a expressão regular impede que o espaços sejam digitados neste campo -->
                                <input 
                                    onkeyup="this.value=this.value.replace(/[' ']/g,'')" type="password" 
                                    class="form-control hb-form-input" 
                                    id="senha" 
                                    placeholder="Sua senha"
                                    name="senha_input"
                                >
                                <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                            </div>
                            
                            <h6 class="hb-txt-white text-justify pt-2 pb-2">
                                <a href="#" class="hb-txt-secondary text-decoration-none">
                                    Esqueci minha senha 
                                </a> 
                            </h6>
                            <h6 class="hb-txt-white text-justify pt-2 pb-2">
                                Não tem uma conta?  
                                <a href="/house_of_barber/cliente/registrar" class="hb-txt-secondary text-decoration-none" id="registre-se">
                                    Registre-se
                                </a>.
                            </h6>

                            <button 
                                type="button"
                                class="btn fa-btn hb-btn-secondary hb-w-700 hb-full-width mt-2"
                                id="btn_login_cliente"
                            >
                                Entrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>