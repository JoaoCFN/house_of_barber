<section class="main_content px-4 py-3">
    <div class="card hb-bg-primary mt-3 px-4 py-3">
        <div class="hb-flex-between">
            <div>
                <h4 class="hb-txt-secondary hb-w-700">
                    <i class="bx bx-time"></i>
                    <span>Dias de funcionamento</span>
                </h4>
                <p class="hb-txt-white hb-w-400">
                    Aqui você tem o controle dos dias de funcionamento da sua barbearia. Ainda não tem nenhum dia de funcionamento cadastrado? Comece o cadastro interagindo com a tabela abaixo.
                </p>
            </div>

            <div class="align-self-center">
                <button 
                    class="btn hb-btn-secondary-circle"
                    data-toggle='modal' 
                    data-target='#modal-inserir-dia-funcionamento'
                >
                    <i class='bx bx-time'></i>
                </button>
            </div>
        </div>

        <table 
            id="table-dias-funcionamento-barbearia" 
            class="table table-responsive-sm" style="width: 100%"
        >
            <thead
                class="hb-bg-primary hb-txt-white"
            >
                <tr>
                    <th>Dia</th>
                    <th>Horário de abertura</th>
                    <th>Horário de fechamento</th>
                    <th>Editar</th>
                    <th>Deletar</th>
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
    id="modal-inserir-dia-funcionamento" 
    tabindex="-1" 
    role="dialog" 
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title hb-w-700 hb-txt-secondary">
                    Inserir dia de funcionamento
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="pt-3" id="inserir_dia_funcionamento" method="post">
                    <div class="form-group icone_dentro_input">
                        <div class="form-group">
                            <select 
                                class="form-control hb-form-input" 
                                id="dia" 
                                name="dia_input"
                            >
                                <option value="">Dia de funcionamento</option>
                                <option value="0">Segunda-feira</option>
                                <option value="1">Terça-feira</option>
                                <option value="2">Quarta-feira</option>
                                <option value="3">Quinta-feira</option>
                                <option value="4">Sexta-feira</option>
                                <option value="5">Sábado</option>
                                <option value="6">Domingo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input horario-mask" 
                                    id="horario_abertura" 
                                    placeholder="Horário de abertura"
                                    name="horario_abertura_input"
                                >
                                <ion-icon name="time-outline" id="icone_horario_abertura">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input horario-mask" 
                                    id="horario_fechamento" 
                                    placeholder="Horário de fechamento"
                                    name="horario_fechamento_input"
                                >
                                <ion-icon name="time-outline" id="icone_horario_fechamento">
                                </ion-icon>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button 
                            type="button"
                            class="btn hb-btn-secondary-default hb-w-700"
                            id="btn_inserir_dia_funcionamento"
                            onclick="insertOperatingDay()"
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
    id="modal-editar-dia-funcionamento" 
    tabindex="-1" 
    role="dialog" 
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title hb-w-700 hb-txt-secondary">
                    Editar dia de funcionamento
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="pt-3" id="editar_dia_funcionamento" method="post">
                    <div class="form-group icone_dentro_input">
                        <div class="form-group">
                            <select 
                                class="form-control hb-form-input" 
                                id="dia" 
                                name="dia_input"
                                disabled="disabled"
                            >
                                <option value="">Dia de funcionamento</option>
                                <option value="0">Segunda-feira</option>
                                <option value="1">Terça-feira</option>
                                <option value="2">Quarta-feira</option>
                                <option value="3">Quinta-feira</option>
                                <option value="4">Sexta-feira</option>
                                <option value="5">Sábado</option>
                                <option value="6">Domingo</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="horario_abertura" 
                                    placeholder="Horário de abertura"
                                    name="horario_abertura_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="time-outline" id="icone_horario_abertura">
                                </ion-icon>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group icone_dentro_input">
                                <input 
                                    type="text" 
                                    class="form-control hb-form-input" 
                                    id="horario_fechamento" 
                                    placeholder="Horário de fechamento"
                                    name="horario_fechamento_input"
                                    disabled="disabled"
                                >
                                <ion-icon name="time-outline" id="icone_horario_fechamento">
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