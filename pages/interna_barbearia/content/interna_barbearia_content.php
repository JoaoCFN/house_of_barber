<section class="gap-to-menu barbearia">
    <picture class="image" alt="Imagem sessao 1">
        <source media="(max-width: 700px)" srcset="../assets/images/agende-servico-mobile.jpg">
        <img 
            src="../assets/images/agende-servico.jpg" 
            alt="Agende seu serviço"
        />
    </picture>
    
    <div class="container">
        <!-- Informações -->
        <div class="informacoes">
            <div class="row">
                <div class="col-md-6 col-sm-12 align-self-center hb-mt-5">
                    <h3 class="hb-txt-secondary hb-w-700 text-break" id="nome-barbearia"></h3>
                </div> 
                <div class="col-md-6 col-sm-12 align-self-center hb-mt-5">
                    <div class="hb-txt-black hb-w-700 text-center hb-float-right" id="status"></div>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-12 align-self-center mt-2">
                    <p class="hb-w-500 hb-txt-white">
                        <i class="fa fa-phone"></i>
                        <span class="ml-1" id="telefone"></span>
                    </p> 
                    
                    <p class="hb-w-500 hb-txt-white">
                        <i class="fa fa-map-marker"></i>
                        <span class="ml-1" id="endereco"></span>
                    </p>   
                    
                </div> 
                <div class="col-md-4 col-sm-12 hb-mt-2">
                    <p class="hb-w-500 hb-txt-white hb-float-right">
                        <i class="fa fa-clock-o"></i>
                        <span class="ml-1" id="horario"></span>
                    </p>    
                </div> 
            </div>
        </div>

        <!-- Agendamento -->
        <div class="agendamento mt-5">
            <!--PEN CONTENT -->
            <div class="content">
                <!--content inner-->
                <div class="content__inner">
                    <div class="container">
                        <div class="container overflow-hidden">
                            <!--multisteps-form-->
                            <div class="multisteps-form mt-1">
                                <!--progress bar-->
                                <div class="row">
                                    <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                                        <div class="multisteps-form__progress">
                                            <button class="multisteps-form__progress-btn js-active" type="button" title="User Info" disabled>
                                                Dia
                                            </button>
    
                                            <button class="multisteps-form__progress-btn" type="button" title="Address" disabled>
                                                Horário
                                            </button>
    
                                            <button class="multisteps-form__progress-btn" type="button" title="Order Info" disabled>
                                                Serviço
                                            </button>
    
                                            <button class="multisteps-form__progress-btn" type="button" title="Comments" disabled>
                                                Confirmação
                                            </button>
                                        </div>
                                    </div>
                                </div>
    
                                <!--form panels-->
                                <div class="row">
                                    <div class="col-12 col-lg-8 m-auto">
                                        <form class="multisteps-form__form" id="agendamento"  method="post">
                                            <!--Dia-->
                                            <div class="multisteps-form__panel shadow p-4 rounded js-active">
                                                <h3 class="multisteps-form__title hb-txt-white hb-w-900">
                                                    Escolha o dia desejado
                                                </h3>
                                                <div class="multisteps-form__content">
                                                    <div class="mt-4">
                                                    <input 
                                                        class="datepicker hb-form-input hb-full-width pl-3"
                                                        placeholder="Clique para selecionar o dia"
                                                        id="dia-agendamento"
                                                        name="dia_input"
                                                        data-target-title="btn-dia"
                                                        onChange="handleButton(this);"
                                                    />
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button 
                                                            class="btn hb-btn-secondary-default js-btn-next hb-w-700 ml-auto" 
                                                            type="button" 
                                                            title="Prev"
                                                            id="btn-dia"
                                                            disabled
                                                        >
                                                            Próximo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <!--Horário-->
                                            <div class="multisteps-form__panel shadow p-4 rounded">
                                                <h3 class="multisteps-form__title hb-txt-white hb-w-900">
                                                    Escolha o horário desejado
                                                </h3>
                                                <div class="multisteps-form__content">
                                                    <div class="mt-4">
                                                    <input 
                                                        class="timepicker hb-form-input hb-full-width pl-3"
                                                        placeholder="Clique para selecionar o horário"
                                                        id="horario-agendamento"
                                                        name="horario_input"
                                                        data-target-title="btn-horario"
                                                        onChange="handleButton(this);"
                                                    />
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn hb-btn-secondary-default js-btn-prev hb-w-700" type="button" title="Prev">
                                                            Anterior
                                                        </button>
                                                        <button 
                                                            class="btn hb-btn-secondary-default js-btn-next hb-w-700 ml-auto" 
                                                            type="button" 
                                                            title="Prev"
                                                            id="btn-horario"
                                                            onclick="loadServices()"
                                                            disabled
                                                        >
                                                            Próximo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <!--Serviço-->
                                            <div class="multisteps-form__panel shadow p-4 rounded" data-animation="scaleIn">
                                                <h3 class="multisteps-form__title hb-txt-white hb-w-900">
                                                    Informe o serviço desejado
                                                </h3>
                                                <div class="multisteps-form__content">
                                                    <div class="servicos mt-3"></div>                                   
                                                </div>
                                                <div class="row">
                                                    <div class="button-row d-flex mt-4 col-12">
                                                        <button class="btn hb-btn-secondary-default js-btn-prev hb-w-700" type="button" title="Prev">
                                                            Anterior
                                                        </button>
                                                        <button 
                                                            class="btn hb-btn-secondary-default js-btn-next hb-w-700 ml-auto" 
                                                            type="button" 
                                                            title="Prev"
                                                            id="btn-servico"
                                                            disabled
                                                        >
                                                            Próximo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Confirmar Serviço-->
                                            <div class="multisteps-form__panel shadow p-4 rounded" data-animation="scaleIn">
                                                <h3 class="multisteps-form__title hb-txt-white hb-w-900">
                                                    Confirmar serviço
                                                </h3>
                                                <div class="multisteps-form__content">
                                                    <div class="mt-3 mb-3" >
                                                        <h5 class="multisteps-form__title hb-txt-white hb-w-500" id="nome-cliente"></h5>
                                                        <div id="confirmar-servico-content"></div>
                                                    </div>
                                                    <div class="button-row d-flex mt-4">
                                                        <button class="btn hb-btn-secondary-default js-btn-prev hb-w-700" type="button" title="Prev">
                                                            Anterior
                                                        </button>
                                                        <button class="btn hb-btn-green ml-auto hb-w-700" type="button" onclick="sendScheduling()">
                                                            Agendar
                                                        </button>
                                                    </div>
                                                </div>
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
    </div>  
</section>

