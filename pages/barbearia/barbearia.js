const ctx = document.getElementById('graph-qtd-total-agendamentos').getContext('2d');
const apiPath = "/house_of_barber/api";

const loadCardsData = () => {
    loading();

    const token = Cookies.get('user_token');

    const headers = {
        'Content-Type': 'application/json',
        'token': token
    };

    request(`${apiPath}/agendamentos/dashboard`, headers, 'GET', '', (dataCards) => {
        document.querySelector("#total_agendamentos").innerHTML = dataCards[0].total_agendamentos;
        document.querySelector("#agendamentos_pendentes").innerHTML = dataCards[1].total_agendamentos_pendentes;
        document.querySelector("#agendamentos_finalizados").innerHTML = dataCards[2].total_agendamentos_finalizados;
        document.querySelector("#media_avaliacoes").innerHTML = dataCards[3].media_avaliacoes;

        request(`${apiPath}/agendamentos/dashboard/grafico`, headers, 'GET', '', (dataChart) => {
            console.log(dataChart);

            let labels = [];
            let responseData = [];

            dataChart.forEach(chart => {
                labels.push(chart.data);

                responseData.push(chart.total_agendamentos);
            });

            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Casos por dia no mês atual',
                            data: responseData,
                            backgroundColor:  'rgb(255, 193, 7)',
                            borderColor: 'rgba(255, 193, 7, .6)',
                            borderWidth: 1,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: false
                            }  
                        }]
                    }
                }
            });

            closeLoading();
        });
    });
};

loadCardsData();