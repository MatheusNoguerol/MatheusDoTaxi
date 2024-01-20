
<script>
export default {
    data(){
        return{
            hoje: null,
            hojeNoFormat: null,
            arrayChart: [],
            arrayTipoCliente: [],
            dadosTipoCliente: [],
            dadosData: [],
            arrayDatas: [],

            isBusyClientes: false,
            fieldsClientes: [
                {
                    key: 'CODCLIENTE',
                    label: 'Cód. cliente',
                    sortable: true
                },
                {
                    key: 'NOME',
                    label: 'Nome',
                    sortable: true
                },
                {
                    key: 'TIPOCLIENTE',
                    label: 'Tipo',
                    sortable: true
                },
                
                {
                    key: 'acoes',
                    label: 'Ações',
                    sortable: true
                },
            ],
            itemsClientes: [],
            currentPageClientes: 1,
            temCliente: false,
            naoTemCliente: false,
        }
    },

    computed: {
        rowsClientes() {
            return this.itemsClientes.length
        }
    },

    props: {
        user: {
            type: String,
            default: '',
            required: true
        }
    },
    
    mounted() {
        let self = this

        self.preLoad()

        function formatDate(date) {
            var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

            if (month.length < 2){
                month = '0' + month;
            } 
            if (day.length < 2) {
                day = '0' + day;
            }

            return [year, month, day].join('-');
        }

        var today = new Date();
            
        self.hoje = formatDate(today)
        self.hoje = self.hoje.split('-').reverse().join('/')
        self.hojeNoFormat = formatDate(today)
    },  

  methods:{
    preLoad(){
        let self = this

        self.chargingCharts()
    },

    chargingCharts(){
        let self = this

        self.arrayTipoCliente = []
        self.arrayDatas = []

        axios.get('charging-charts-painel')
        .then((response)=> {
            console.log('busca dados:', response)

            self.dadosTipoCliente = self.arrayTipoCliente
            self.dadosData = self.arrayDatas

            for(var f=0; f < response.data.chartClientType.length; f++){

                self.arrayTipoCliente.push({name: response.data.chartClientType[f].TIPOCLIENTE, y: parseInt(response.data.chartClientType[f].qtd)})

            }
            
            for(var f=0; f < response.data.birthChart.length; f++){

                self.arrayDatas.push({name: response.data.birthChart[f].TIPO, y: parseInt(response.data.birthChart[f].length)})

            }

            Highcharts.chart('tipo-cliente', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Tipo Cliente'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                    valueSuffix: '%'
                    }
                },
                credits: false,
                plotOptions: {
                    pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: false
                    }
                },
                series: [{
                    name: 'Valor',
                    colorByPoint: true,
                    data: self.dadosTipoCliente,
                    point: {
                        events: {
                            click: function (e) {
                                self.isBusyClientes = true
                                self.temCliente = false
                                self.naoTemCliente = false
                                self.currentPageClientes = 1
                                self.$bvModal.show('modal-tipo-cliente')
                                axios.post('info-chart-client-type', {name: e.point.name})
                                .then((response) =>{

                                    console.log('aquiu: ',response)
                                    self.arrayTipoCliente = []

                                    for(var k=0; k<response.data.length; k++){

                                        // self.arrayTipoCliente.push({
                                        //     data: response.data[k].data,
                                        //     dataForm: (response.data[k].data.slice(0,10)).split('-').reverse().join('/'),
                                        //     documento_origem: response.data[k].documento_origem,
                                        //     fim: response.data[k].fim,
                                        //     id: response.data[k].id,
                                        //     id_rotina: response.data[k].id_rotina,
                                        //     inicio: response.data[k].inicio,
                                        //     obs: response.data[k].obs,
                                        //     status: response.data[k].status,
                                        //     tipo_solicitacao: response.data[k].tipo_solicitacao,
                                        //     usuario: response.data[k].usuario,
                                        //     nota_pesquisa: response.data[k].nota_pesquisa
                                        // })
                                    }

                                    self.isBusyClientes = false

                                }).catch((error)=>{
                                    console.log('error', error);
                                })
                            }
                        }
                    }
                }]
            });
        
            Highcharts.chart('chart-date', {
                chart: {
                    type: 'column'
                },
                colors: ['#214CCE'],
                title: {
                    text: 'Destribuição de idades'
                },
                credits: false,
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    categories: ['Sem Data', '0-20', '21-65', '+65']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Número de Pessoas'
                    }
                },
                legend: {
                    enabled: false
                },
                series: [{
                    name: 'Idades',
                    data: self.arrayDatas,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        y: 10,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function (e) {
                                self.isBusyOsDiaAnterior = true
                                self.temRegistroSelecionado = false
                                self.currentPageOsDiaAnterior = 1
                                self.$bvModal.show('modal-os-dia-anterior')

                                axios.post('grafico-os-dia-anterior', {name: e.point.name, de: self.dtInicio, ate: self.dtFim})
                                .then((response) =>{
                                    self.arrayOsDiaAnterior = []

                                    console.log(response)

                                    for(var k=0; k<response.data.length; k++){
                                        self.arrayOsDiaAnterior.push({
                                            data: response.data[k].data,
                                            dataForm: (response.data[k].data.slice(0,10)).split('-').reverse().join('/'),
                                            documento_origem: response.data[k].documento_origem,
                                            fim: response.data[k].fim,
                                            id: response.data[k].id,
                                            id_rotina: response.data[k].id_rotina,
                                            inicio: response.data[k].inicio,
                                            obs: response.data[k].obs,
                                            status: response.data[k].status,
                                            tipo_solicitacao: response.data[k].tipo_solicitacao,
                                            usuario: response.data[k].usuario,
                                            nota_pesquisa: response.data[k].nota_pesquisa
                                        })
                                    }

                                    self.isBusyOsDiaAnterior = false
                                }).catch((error)=>{
                                    console.log('error', error);
                                })
                            }
                        }
                    }
                }]
            });
        })
    },

    selecionaCliente(row){
        let self = this

        console.log(row)
    }
  },
}
</script>

<style scoped>

    #btn-selecao:hover{
        background-color: blue;
        color: white;
        font-weight: bolder;
        border: none;
    }

    .charts{
        border-radius: 4rem;
        padding: 1rem;
        margin: 1rem;
    }

</style>

<template>
    <div>
        <h1 class="text-center">Painel</h1>

        <div class="bg-white rounded p-2 mt-2 mb-2 ml-5 mr-5">
            <b-row class="my-5">

                <b-col lg="12">
                    <b-tabs>
                        <b-tab title="Dados cadastrais" active>
                            <b-row class="my-5">
                                <b-col>
                                    <div id="chart-date" class="charts"></div>
                                </b-col>
                            </b-row>

                            <hr class="secondary w-100">

                            <b-row class="my-5">
                                <b-col lg="4">

                                    <div id="tipo-cliente" class="charts"></div>

                                </b-col>

                                <b-col lg="4">

                                    <div id="responsavel-cadastro" class="charts"></div>

                                </b-col>
                            </b-row>
                        </b-tab>

                        <b-tab title="Dados veiculares">
                            
                        </b-tab>

                        <b-tab title="Dados financeiros">

                        </b-tab>

                        <b-tab title="Anexos">

                        </b-tab>
                    </b-tabs>
                </b-col>

            </b-row>
        </div>

        <b-modal id="modal-tipo-cliente" size="lg" ok-only ok-title="Fechar">
            <div class="col-lg-12">
                <b-table hover outlined responsive
                    id="clientes-pessoa-table"
                    head-variant="light"
                    :busy="isBusyClientes"
                    :fields="fieldsClientes"
                    :items="itemsClientes"
                    per-page="10"
                    :current-page="currentPageClientes">
                    <template #table-busy>
                        <div class="text-center text-primary my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Carregando...</strong>
                        </div>
                    </template>

                    <template #cell(acoes)="row">
                        <b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Selecionar Cliente" @click="selecionaCliente(row)">
                            <i class="fas fa-eye p-0 m-0"></i>
                        </b-button>
                    </template>
                </b-table>
            </div>
            <div class="col col-lg-12 mt-0 pt-0" v-if="temCliente == true">
                <div class="justify-content-end d-flex mt-0 pt-0">
                    <small class="text-muted mt-0 pt-0"><p>{{rowsClientes}} registros encontrados.</p></small>
                </div>
            </div>
            <b-col class="text-center justify-content-center d-flex" v-if="naoTemCliente == true">
                <h4 class="text-white bg-danger p-5 rounded w-75">Nenhum registro foi encontrado.</h4>
            </b-col>
            <div class="col col-lg-12 mt-1" v-if="temCliente == true">
                <div class="justify-content-center d-flex">
                    <b-pagination
                        v-model="currentPageClientes"
                        :total-rows="rowsClientes"
                        per-page="10"
                        aria-controls="clientes-pessoa-table">
                    </b-pagination>
                </div>
            </div>
        </b-modal>
        
        
    </div>   
</template>
