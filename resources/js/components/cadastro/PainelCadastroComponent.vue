
<script>
export default {
    data(){
        return{
            hoje: null,
            hojeNoFormat: null,
            arrayChart: [],
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

        axios.post('charging-charts-painel', {dtInicio: self.dtInicio, dtFim: self.dtFim})
        .then((response)=> {
            console.log('busca dados:', response)

            // for(var x=0; x<response.data.length; x++){

            //     arrayChart.push({name: response.data.projeto_feedback_nomes_etapas[x].nome_etapa, y: parseInt(response.data.projeto_feedback_nomes_etapas[x].Qtd_nome_etapa)})

            // }


            // self.indicadores = true
            // self.projetoNomesEtapas = arrayProjetoNomesEtapas
            // self.canceladosTotal = arrayCanceladosTotal
            // self.concluidoTotal = arrayConcluidoTotal
            // self.andamentoTotal = arrayAndamento
            // self.pendenteTotal = arrayPendente
            // self.suspensoTotal = arraySuspenso

            // Highcharts.chart('teste', {
            //     chart: {
            //         type: 'column'
            //     },
            //     colors: ['#DE2929'],
            //     title: {
            //         text: 'Etapas por nome'
            //     },
            //     credits: false,
            //     xAxis: {
            //         type: 'category',
            //         labels: {
            //             rotation: -45,
            //             style: {
            //                 fontSize: '13px',
            //                 fontFamily: 'Verdana, sans-serif'
            //             }
            //         }
            //     },
            //     yAxis: {
            //         min: 0,
            //         title: {
            //         text: 'Quantidade'
            //         }
            //     },
            //     legend: {
            //         enabled: false
            //     },
            //     tooltip: {
            //         pointFormat: 'Quantidade: {point.y}'
            //     },
            //     series: [{
            //         name: 'Population',
            //         data: self.projetoNomesEtapas,
            //         dataLabels: {
            //             enabled: true,
            //             rotation: -90,
            //             color: '#FFFFFF',
            //             align: 'right',
            //             format: '{point.y}',
            //             y: 10,
            //             style: {
            //                 fontSize: '13px',
            //                 fontFamily: 'Verdana, sans-serif'
            //             }
            //         },
            //         cursor: 'pointer',
            //         point: {
            //             events: {
            //                 click: function (e) {
            //                     axios.post('busca-projeto-nome', {nomeEtapa: e.point.name, de: self.dtInicio, ate: self.dtFim})
            //                     .then((response) =>{

            //                         self.showDados = false
            //                         self.itemsCancelados = []
            //                         self.itemsConcluidos = []
            //                         self.itemsAndamentos = []
            //                         self.itemsPendentes = []
            //                         self.itemsSuspensos = []


            //                         for(var i=0; i<response.data.length; i++){

            //                             switch(response.data[i].status){

            //                                 case 'Cancelado':
            //                                     self.itemsCancelados.push(response.data[i])
            //                                 break;

            //                                 case 'Concluído':
            //                                     self.itemsConcluidos.push(response.data[i])
            //                                 break;

            //                                 case 'Em Andamento':
            //                                     self.itemsAndamentos.push(response.data[i])
            //                                 break;

            //                                 case 'Pendente':
            //                                     self.itemsPendentes.push(response.data[i])
            //                                 break;

            //                                 case 'Suspenso':
            //                                     self.itemsSuspensos.push(response.data[i])
            //                                 break;
            //                             }
            //                         }

            //                         self.$refs['projeto-etapas-modal'].show()

            //                     }).catch((error)=>{

            //                     })
            //                 }
            //             }
            //         }
            //     }]
            // });
            // self.temDados = true
        })
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

</style>

<template>
    <div>
        <h1 class="text-center">Painel</h1>
        <b-row class="my-5">
            <b-col lg="12">

                <div id="teste"></div>

            </b-col>
        </b-row>
    </div>   
</template>
