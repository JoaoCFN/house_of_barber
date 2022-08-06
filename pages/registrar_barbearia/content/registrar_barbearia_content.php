<section class="registro_barbearia hb-bg-black hb-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 align-self-center mt-2 mb-2">
                <div class="card hb-card mb-3">
                    <div class="card-body">
                        <h4 class="hb-txt-white hb-text-md">
                            Registre sua barbearia 
                        </h4>

                        <form class="pt-3" id="form_registro" method="POST">
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
                                        name="nome_admin"
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
                                            class="form-control hb-form-input maskTelefone" 
                                            id="telefone_admin" 
                                            placeholder="Telefone"
                                            name="telefone_admin"
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
                                            class="form-control hb-form-input maskCPF" 
                                            id="cpf_admin" 
                                            placeholder="CPF"
                                            name="cpf_admin"
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
                                        name="email"
                                    >
                                    <ion-icon name="mail-outline" id="icone_email">
                                    </ion-icon>
                                </div>
                            </div>
                            
                            <!-- SENHA E CONFIRMAR SENHA -->
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <!-- campo de senha -->
                                    <div class="form-group icone_dentro_input">
                                        <!-- O atributo onkeyup juntamente com a expressão regular impede que o espaços sejam digitados neste campo -->
                                        <input 
                                            onkeyup="this.value=this.value.replace(/[' ']/g,'')" type="password" 
                                            class="form-control hb-form-input" 
                                            id="senha" 
                                            placeholder="Sua senha"
                                            name="senha"
                                        >
                                        <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <!-- Confirmar de senha -->
                                    <div class="form-group icone_dentro_input">
                                        <!-- O atributo onkeyup juntamente com a expressão regular impede que o espaços sejam digitados neste campo -->
                                        <input 
                                            onkeyup="this.value=this.value.replace(/[' ']/g,'')" type="password" 
                                            class="form-control hb-form-input" 
                                            id="confirmar_senha" 
                                            placeholder="Confirme sua senha"
                                            name="confirmar_senha"
                                        >
                                        <ion-icon name="lock-closed-outline" id="icone_senha"></ion-icon>
                                    </div>
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
                                            name="nome_barbearia"
                                        >
                                        <ion-icon name="home-outline" id="icone_nome_barbearia"></ion-icon>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">                                    
                                    <!-- campo de telefone da barbearia -->
                                    <div class="form-group icone_dentro_input">
                                        <input 
                                            type="text" 
                                            class="form-control hb-form-input maskTelefone" 
                                            id="telefone_barbearia" 
                                            placeholder="Telefone"
                                            name="telefone_barbearia"
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
                                    <div class="form-group icone_dentro_input">
                                        <input 
                                            class="form-control hb-form-input maskCEP" 
                                            id="cep" 
                                            placeholder="CEP"
                                            name="cep"
                                        >
                                        <ion-icon name="location-outline" id="icone_cep"></ion-icon>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <!-- Confirmar de CNPJ -->
                                    <div class="form-group icone_dentro_input">
                                        <input 
                                            class="form-control hb-form-input maskCNPJ" 
                                            id="cnpj" 
                                            placeholder="CNPJ"
                                            name="cnpj"
                                        >
                                        <ion-icon name="card-outline" id="icone_cnpj"></ion-icon>
                                    </div>
                                </div>
                            </div>

                            <!-- RUA, NÚMERO, BAIRRO -->
                            <div class="form-row">
                                <div class="col-sm-12 col-md-4">
                                    <!-- campo de Rua -->
                                    <div class="form-group icone_dentro_input">
                                        <input 
                                            class="form-control hb-form-input" 
                                            id="rua" 
                                            placeholder="Rua"
                                            name="rua"
                                        >
                                        <ion-icon name="map-outline" id="icone_rua"></ion-icon>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <!-- campo de numero -->
                                    <div class="form-group icone_dentro_input">
                                        <input 
                                            class="form-control hb-form-input" 
                                            id="numero_endereco_barbearia" 
                                            placeholder="Nº"
                                            name="numero_endereco_barbearia"
                                        >
                                        <ion-icon name="map-outline" id="icone_numero"></ion-icon>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    <!-- campo de bairro -->
                                    <div class="form-group icone_dentro_input">
                                        <input 
                                            class="form-control hb-form-input" 
                                            id="bairro" 
                                            placeholder="Bairro"
                                            name="bairro"
                                        >
                                        <ion-icon name="map-outline" id="icone_bairro"></ion-icon>
                                    </div>
                                </div>
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
                                            name="cidade"
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
                                            name="estado"
                                        >
                                        <ion-icon name="map-outline" id="icone_estado"></ion-icon>
                                    </div>
                                </div>
                            </div>

                            <button 
                                type="button"
                                class="btn fa-btn hb-btn-secondary hb-w-700 hb-full-width mt-2" 
                            >
                                Cadastrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 align-self-center" id="banner-registro-barbearia">
                <img src="../assets/images/back-registro.jpg" alt="registro" id="img-registro">
            </div>
        </div>
    </div>
</section>