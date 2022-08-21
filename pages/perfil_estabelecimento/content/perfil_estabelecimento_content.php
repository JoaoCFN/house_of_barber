<section class="main_content px-4 py-3">
    <div class="container perfil-estabelecimento card hb-bg-primary">
        <div class="row p-3">
            <div class="col-lg-5 col-md-5 col-sm-12" id="foto-perfil">
                <img 
                    class="img-fluid"
                    id="img-foto-perfil"
                    alt="foto-perfil"
                >
                <input 
                    type="file" 
                    class="form-control-file hb-txt-white hb-bg-black hb-d-none"
                    id="upload_file"
                    name="upload_file" 
                    accept="image/png, image/gif, image/jpeg"
                    id="upload_file"
                />
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 mt-4">
                <h4 class="hb-txt-secondary hb-w-700 text-center">
                    MINHA BARBEARIA
                </h4>

                <form class="pt-3" id="perfil_estabelecimento" method="POST">
                    <h6 class="hb-txt-white hb-text-sm pb-2">
                        Pessoal
                    </h6>

                    <div>
                        <!-- NOME COMPLETO -->
                        <div class="form-group icone_dentro_input">
                            <input 
                                type="text" 
                                class="form-control hb-form-input" 
                                id="nome_admin" 
                                placeholder="Nome completo"
                                name="nome_admin_input"
                                disabled="disabled"
                            >
                            <ion-icon name="person-outline" id="icone_nome">
                            </ion-icon>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">                                    
                            <!-- campo de telefone do admin -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input telefone-mask" 
                                    id="telefone_admin" 
                                    placeholder="Telefone"
                                    name="telefone_admin_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="call-outline" id="icone_telefone">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- campo de cpf -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input cpf-mask" 
                                    id="cpf_admin" 
                                    placeholder="CPF"
                                    name="cpf_admin_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="card-outline" id="icone_cpf">
                                </ion-icon>
                            </div>
                        </div>
                    </div>
                    
                    <!-- EMAIL -->
                    <div>
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
                    </div>

                    <h6 class="hb-txt-white hb-text-sm pb-2">
                        Estabelecimento
                    </h6>
                    <!-- NOME DA BARBEARIA E TELEFONE -->
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <!-- campo de nome da barbearia -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    class="form-control hb-form-input" 
                                    id="nome_barbearia" 
                                    placeholder="Nome da barbearia"
                                    name="nome_barbearia_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="home-outline" id="icone_nome_barbearia"></ion-icon>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">                                    
                            <!-- campo de telefone da barbearia -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input telefone-mask" 
                                    id="telefone_barbearia" 
                                    placeholder="Telefone"
                                    name="telefone_barbearia_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="call-outline" id="icone_telefone">
                                </ion-icon>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CEP e CNPJ -->
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <!-- campo de CEP -->
                            <div class="form-group d-flex">
                                <div class="icone_dentro_input">
                                    <input 
                                        class="form-control hb-form-input cep-mask" 
                                        id="cep" 
                                        placeholder="CEP"
                                        name="cep_input"
                                        disabled="disabled"
                                    >
                                    <ion-icon name="location-outline" id="icone_cep"></ion-icon>
                                </div>
                                <div>
                                    <button 
                                        type="button"
                                        class="btn hb-btn-secondary"
                                        id="button_cep"
                                    >
                                        <ion-icon name="search-outline"></ion-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <!-- Confirmar de CNPJ -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    class="form-control hb-form-input cnpj-mask" 
                                    id="cnpj" 
                                    placeholder="CNPJ"
                                    name="cnpj_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="card-outline" id="icone_cnpj"></ion-icon>
                            </div>
                        </div>
                    </div>

                    <!-- RUA E NÚMERO -->
                    <div class="form-row">
                        <div class="col-sm-12 col-md-8">
                            <!-- campo de Rua -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    class="form-control hb-form-input" 
                                    id="rua" 
                                    placeholder="Rua"
                                    name="rua_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="map-outline" id="icone_rua"></ion-icon>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <!-- campo de numero -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    class="form-control hb-form-input" 
                                    id="numero_endereco_barbearia" 
                                    placeholder="Nº"
                                    name="numero_endereco_barbearia_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="map-outline" id="icone_numero"></ion-icon>
                            </div>
                        </div>
                    </div>

                    <!-- campo de bairro -->
                    <div class="form-group icone_dentro_input">
                        <input 
                            class="form-control hb-form-input" 
                            id="bairro" 
                            placeholder="Bairro"
                            name="bairro_input"
                            disabled="disabled"
                        >
                        <ion-icon name="map-outline" id="icone_bairro"></ion-icon>
                    </div>

                    <!-- CIDADE E UF -->
                    <div class="form-row">
                        <div class="col-sm-12 col-md-8">
                            <!-- campo de cidade -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    class="form-control hb-form-input" 
                                    id="cidade" 
                                    placeholder="Cidade"
                                    name="cidade_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="map-outline" id="icone_cidade"></ion-icon>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <!-- campo de estado -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    class="form-control hb-form-input maskUF" 
                                    id="estado" 
                                    placeholder="UF"
                                    name="estado_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="map-outline" id="icone_estado"></ion-icon>
                            </div>
                        </div>
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
