<section class="registro hb-bg-black hb-content">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 align-self-center mt-4 mb-4">
                <div class="card hb-card mb-3">
                    <div class="card-body">
                        <h4 class="hb-txt-white hb-text-md">
                            Crie sua conta 
                        </h4>

                        <form class="pt-3" id="registrar_cliente" method="post">
                            <!-- campo de nome -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="nome" 
                                    placeholder="Seu nome"
                                    name="nome_input"
                                >
                                <ion-icon name="person-outline" id="icone_nome">
                                </ion-icon>
                            </div>

                            <!-- campo de telefone -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input telefone-mask" 
                                    id="telefone" 
                                    placeholder="Telefone"
                                    name="telefone_input"
                                >
                                <ion-icon name="call-outline" id="icone_telefone">
                                </ion-icon>
                            </div>

                            <!-- campo de data nascimento -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="date" 
                                    class="form-control hb-form-input" 
                                    id="data_nascimento" 
                                    placeholder="Data Nascimento"
                                    name="data_nascimento_input"
                                >
                                <ion-icon name="calendar-outline" id="icone_data_nascimento">
                                </ion-icon>
                            </div>

                            <!-- campo de cpf -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input cpf-mask" 
                                    id="cpf" 
                                    placeholder="CPF"
                                    name="cpf_input"
                                >
                                <ion-icon name="card-outline" id="icone_cpf">
                                </ion-icon>
                            </div>

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

                            <!-- Confirmar de senha -->
                            <div class="form-group icone_dentro_input">
                                <!-- O atributo onkeyup juntamente com a expressão regular impede que o espaços sejam digitados neste campo -->
                                <input 
                                    onkeyup="this.value=this.value.replace(/[' ']/g,'')" type="password" 
                                    class="form-control hb-form-input" 
                                    id="confirmar_senha" 
                                    placeholder="Confirme sua senha"
                                    name="confirmar_senha_input"
                                >
                                <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                            </div>

                            <button 
                                type="button"
                                class="btn fa-btn hb-btn-secondary hb-w-700 hb-full-width mt-2"
                                id="btn_registar_cliente"
                                name="cadastrar" 
                            >
                                Cadastrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 align-self-center text-center" id="banner-registro">
                <img src="../assets/images/back-registro.jpg" alt="registro" id="img-registro">
            </div>
        </div>
    </div>
</section>