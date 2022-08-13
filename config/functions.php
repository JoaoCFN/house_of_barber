<?php 
    function createSidebarItem($text, $tooltip, $link, $icon, $itemId){
        ?>
            <li>
                <a href="<?php echo $link; ?>" id="<?php echo $itemId; ?>">
                    <i class='<?php echo $icon; ?>'></i>
                    <span class="links_name">
                        <?php 
                            echo $text;
                        ?>
                    </span>
                </a>
                <span class="tooltip">
                    <?php 
                        echo $tooltip;
                    ?>
                </span>
            </li>
        <?php
    }

    function createCardDeck(){
        ?>
            <div class="row mt-4 mb-4">
                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="blue">
                                        <i class='bx bx-message-check'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Total Casos
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="total_abertos">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-message-check'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Ocorrências abertas
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="green">
                                        <i class='bx bx-time'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Casos Hoje
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="total_abertos_hoje">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-time'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Casos abertos hoje
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="red">
                                        <i class='bx bx-message-rounded-error'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Cont. Líder
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="total_contestados_lider">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-message-rounded-error'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Casos contestados pelo líder
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="yellow">
                                        <i class='bx bx-clipboard'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Tratados Quali
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="total_tratados_quali">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-clipboard'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Tratados pela qualidade
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="blue">
                                        <i class='bx bx-lock'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Fechado Líder
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="fechado_lider">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-lock'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Casos fechados pelos líderes
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="green">
                                        <i class='bx bx-loader'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Em tratativa
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="casos_tratando">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-loader'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Casos em tratativa
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="red">
                                        <i class='bx bx-message-rounded-error'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Cont. Operação
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="total_contestados_operacao">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-message-rounded-error'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Contestados pela operação
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    <div class="mt-card">
                        <div class="card-body">
                            <div class="mt-flex-between">
                                <div class="align-self-center">
                                    <div class="mt-box-icon" data-color="yellow">
                                        <i class='bx bx-door-open'></i>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h5 class="mt-font-montserrat mt-font-700">
                                        Casos Abertos
                                    </h5>
                                    <h5 class="mb-0 mt-font-hind-madurai text-right" id="total_casos_abertos">
                                        0
                                    </h5>
                                </div>
                            </div>

                            <hr>

                            <div class="mt-flex-between mt-font-montserrat mb-0">
                                <div class="legend-icon">
                                    <i class='bx bx-door-open'></i>
                                </div>
                                <div>
                                    <h6 class="box-legend-text mb-0">
                                        Casos em aberto
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }

    function createDashboardChart($title, $description){
        ?>
            <div class="mt-card mb-3">
                <div class="card-body">
                    <h5 class="mt-font-montserrat mt-font-700 mt-color-primary mt-title-with-icon">
                        <i class='bx bx-line-chart'></i>
                        <span class="ml-1">
                            <?php echo $title; ?>
                        </span>
                    </h5>
                    <p class="mt-font-hind-madurai">
                        <?php echo $description; ?>
                    </p>

                    <hr>

                    <!-- Gráfico -->
                    <div class="graph mt-4 mb-4">
                        <canvas id="graph-qtd-total-entrantes"></canvas>
                    </div>
                </div>
            </div>
        <?php
    }