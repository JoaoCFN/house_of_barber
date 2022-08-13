<section class="gap-to-menu container hb-content perfil-cliente">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="card hb-bg-primary p-3">
                <h4 class="hb-txt-secondary hb-w-700 text-center">
                    MEU PERFIL
                </h4>

                <form class="pt-3" id="perfil_cliente" method="post">
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- campo de nome -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="nome" 
                                    placeholder="Seu nome"
                                    name="nome_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="person-outline" id="icone_nome">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                             <!-- campo de telefone -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input telefone-mask" 
                                    id="telefone" 
                                    placeholder="Telefone"
                                    name="telefone_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="call-outline" id="icone_telefone">
                                </ion-icon>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- campo de data nascimento -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="date" 
                                    class="form-control hb-form-input" 
                                    id="data_nascimento" 
                                    placeholder="Data Nascimento"
                                    name="data_nascimento_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="calendar-outline" id="icone_data_nascimento">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- campo de cpf -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input cpf-mask" 
                                    id="cpf" 
                                    placeholder="CPF"
                                    name="cpf_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="card-outline" id="icone_cpf">
                                </ion-icon>
                            </div>
                        </div>
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
                            disabled="disabled"
                        >
                        <ion-icon name="mail-outline" id="icone_email">
                        </ion-icon>
                    </div>
                </form>

                <div class="d-flex justify-content-end">
                    <button 
                        class="btn hb-btn-secondary-default hb-w-700"
                        id="btn_editar"
                    >
                        Editar
                    </button>
                    
                    <div id="edit-buttons" class="d-none">
                        <button 
                            class="btn hb-btn-third hb-w-700"
                            id="btn_cancelar"
                        >
                            Cancelar
                        </button>

                        <button 
                            class="btn hb-btn-secondary-default hb-w-700"
                            id="btn_salvar"
                        >
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
