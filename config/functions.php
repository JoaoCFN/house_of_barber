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
        <div class="card-deck mt-3 mb-4">
            <div class="card hb-card">
                <div class="card-body hb-txt-white">
                    <div class="hb-flex-between">
                        <div class="align-self-center">
                            <div class="hb-box-icon" data-color="yellow">
                                <i class='bx bx-calendar'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="hb-w-700 hb-card-title">
                                Total agendamentos
                            </h5>
                            <h5 class="mb-0 text-right" id="total_agendamentos">
                                0
                            </h5>
                        </div>
                    </div>
    
                    <hr>
    
                    <div class="hb-flex-between mb-0">
                        <div class="legend-icon">
                            <i class='bx bx-calendar'></i>
                        </div>
                        <div>
                            <h6 class="box-legend-text mb-0">
                                Total agendamentos
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card hb-card">
                <div class="card-body hb-txt-white">
                    <div class="hb-flex-between">
                        <div class="align-self-center">
                            <div class="hb-box-icon" data-color="yellow">
                                <i class='bx bx-message-rounded-error'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="hb-w-700 hb-card-title">
                                Agendamentos em aberto
                            </h5>
                            <h5 class="mb-0 text-right" id="agendamentos_pendentes">
                                0
                            </h5>
                        </div>
                    </div>

                    <hr>

                    <div class="hb-flex-between mb-0">
                        <div class="legend-icon">
                            <i class='bx bx-message-rounded-error'></i>
                        </div>
                        <div>
                            <h6 class="box-legend-text mb-0">
                                Agendamentos em aberto
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card hb-card">
                <div class="card-body hb-txt-white">
                    <div class="hb-flex-between">
                        <div class="align-self-center">
                            <div class="hb-box-icon" data-color="yellow">
                                <i class='bx bx-message-check'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="hb-w-700 hb-card-title">
                                Agendamentos finalizados
                            </h5>
                            <h5 class="mb-0 text-right" id="agendamentos_finalizados">
                                0
                            </h5>
                        </div>
                    </div>

                    <hr>

                    <div class="hb-flex-between mb-0">
                        <div class="legend-icon">
                            <i class='bx bx-message-check'></i>
                        </div>
                        <div>
                            <h6 class="box-legend-text mb-0">
                                Agendamentos finalizados
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card hb-card">
                <div class="card-body hb-txt-white">
                    <div class="hb-flex-between">
                        <div class="align-self-center">
                            <div class="hb-box-icon" data-color="yellow">
                                <i class='bx bx-clipboard'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="hb-w-700 hb-card-title">
                                Média das avaliações
                            </h5>
                            <h5 class="mb-0 text-right" id="media_avaliacoes">
                                0
                            </h5>
                        </div>
                    </div>

                    <hr>

                    <div class="hb-flex-between mb-0">
                        <div class="legend-icon">
                            <i class='bx bx-clipboard'></i>
                        </div>
                        <div>
                            <h6 class="box-legend-text mb-0">
                                Média de avaliações
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- <div class="row hb-4 mb-4">
                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    
                </div>
                
                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    
                </div>

                <div class="col-sm-12 col-md-3 mt-3 mb-2">
                    
                </div>
            </div> -->
        <?php
    }

    function createDashboardChart($title, $description){
        ?>
            <div class="hb-card mb-5">
                <div class="card-body">
                    <h5 class="hb-w-700 hb-txt-white hb-title-with-icon">
                        <i class='bx bx-line-chart'></i>
                        <span class="ml-1">
                            <?php echo $title; ?>
                        </span>
                    </h5>
                    <p class="hb-txt-white">
                        <?php echo $description; ?>
                    </p>

                    <hr>

                    <!-- Gráfico -->
                    <div class="graph hb-4 hb-4">
                        <canvas id="graph-qtd-total-agendamentos"></canvas>
                    </div>
                </div>
            </div>
        <?php
    }