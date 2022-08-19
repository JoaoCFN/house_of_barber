<section class="main_content px-4 py-3">
    <div class="card hb-bg-primary mt-3 px-4 py-3">
        <div class="hb-flex-between">
            <div>
                <h4 class="hb-txt-secondary hb-w-700">
                    <i class="bx bx-calendar"></i>
                    <span>Agendamentos</span>
                </h4>
                <p class="hb-txt-white hb-w-400">
                    Aqui você tem o controle dos agendamentos marcados na sua barbearia. Realize o gerenciamento de cada agendamento através da tabela abaixo.
                </p>
            </div>
        </div>

        <table 
            id="table-agendamentos-barbearia" 
            class="table table-responsive-sm" style="width: 100%"
        >
            <thead
                class="hb-bg-primary hb-txt-white"
            >
                <tr>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Serviços</th>
                    <th>Concluir</th>
                    <th>Cancelar</th>
                </tr>
            </thead>
            <tbody
                class="hb-font-300 hb-txt-white"
            >
            </tbody>
        </table>
    </div>
</section>

<!-- Modal Inserir -->
<div 
    class="modal fade" 
    id="modal-inserir-servico" 
    tabindex="-1" 
    role="dialog" 
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title hb-w-700 hb-txt-secondary">
                    Inserir serviço
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="pt-3" id="inserir_servico" method="post">
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- campo de nome -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="nome" 
                                    placeholder="Nome do serviço"
                                    name="nome_input"
                                >
                                <ion-icon name="list-outline" id="icone_servico">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                             <!-- campo de valor -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="number" 
                                    class="form-control hb-form-input" 
                                    id="valor" 
                                    placeholder="Valor do serviço"
                                    name="valor_input"
                                >
                                <ion-icon name="cash-outline" id="icone_valor">
                                </ion-icon>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button 
                            type="button"
                            class="btn hb-btn-secondary-default hb-w-700"
                            id="btn_inserir_servico"
                            onclick="insertService()"
                        >
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div 
    class="modal fade" 
    id="modal-editar-servico" 
    tabindex="-1" 
    role="dialog" 
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title hb-w-700 hb-txt-secondary">
                    Editar serviço
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="pt-3" id="editar_servico" method="post">
                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- campo de nome -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="nome" 
                                    placeholder="Nome do serviço"
                                    name="nome_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="list-outline" id="icone_servico">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                             <!-- campo de valor -->
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="number" 
                                    class="form-control hb-form-input" 
                                    id="valor" 
                                    placeholder="Valor do serviço"
                                    name="valor_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="cash-outline" id="icone_valor">
                                </ion-icon>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button 
                            type="button"
                            class="btn hb-btn-secondary-default hb-w-700"
                            id="modal_btn_editar"
                        >
                            Editar
                        </button>
                        
                        <div id="edit-buttons" class="d-none">
                            <button 
                                type="button"
                                class="btn hb-btn-third hb-w-700"
                                id="modal_btn_cancelar"
                            >
                                Cancelar
                            </button>

                            <button 
                                type="button"
                                class="btn hb-btn-secondary-default hb-w-700"
                                id="modal_btn_salvar"
                            >
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>