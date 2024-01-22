
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
            nomeSelecionado: null,
            dataCadastroSelecionado: null,
            tipoClienteSelecionado: null,
            ratrSelecionado: null,
            responsavelSelecionado: null,
            telefoneSelecionado: null,
            emailSelecionado: null,
            placaSelecionado: null,
            anoFabSelecionado: null,
            anoModSelecionado: null,
            permissaoSelecionado: null,
            tipoChaveSelecionado: null,
            chaveSelecionado: null,
            codClienteSelecionado: null,
            nascimentoSelecionado: null,
            cpfSelecionado: null,
            dadosCategoria: [],
            arrayCategoria: [],
            dadosAliencao: [],
            arrayAlienacao: [],
            dadosDataVeiculo: [],
            arrayDataVeiculo: [],
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
        self.arrayCategoria = []
        self.arrayAlienacao = []
        self.arrayDataVeiculo = []

        axios.get('charging-charts-painel')
        .then((response)=> {
            console.log('busca dados:', response.data)

            self.dadosTipoCliente = self.arrayTipoCliente
            self.dadosData = self.arrayDatas
            self.dadosCategoria = self.arrayCategoria
            self.dadosAliencao = self.arrayAlienacao
            self.dadosDataVeiculo = self.arrayDataVeiculo

            for(var f=0; f < response.data.chartClientType.length; f++){

                self.arrayTipoCliente.push({name: response.data.chartClientType[f].TIPOCLIENTE, y: parseInt(response.data.chartClientType[f].qtd)})

            }
            
            for(var f=0; f < response.data.birthChart.length; f++){

                self.arrayDatas.push({name: response.data.birthChart[f].TIPO, y: parseInt(response.data.birthChart[f].length)})

            }

            for(var f=0; f < response.data.carCategory.length; f++){

                self.arrayCategoria.push({name: response.data.carCategory[f].TIPO, y: parseInt(response.data.carCategory[f].qtd)})

            }

            for(var f=0; f < response.data.documentationAliened.length; f++){

                self.arrayAlienacao.push({name: response.data.documentationAliened[f].TEMALIENACAO == 1 ? 'Alienado' : 'Não alienado', y: parseInt(response.data.documentationAliened[f].qtd)})

            }

            for(var f=0; f < response.data.vehicleDate.length; f++){

                self.arrayDataVeiculo.push({name: response.data.vehicleDate[f].TIPO, y: parseInt(response.data.vehicleDate[f].qtd)})

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
                        enabled: true
                    },
                    showInLegend: true
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

                                    self.itemsClientes = []

                                    for(var k=0; k<response.data.length; k++){

                                        self.itemsClientes.push({
                                            CODCLIENTE: response.data[k].CODCLIENTE,
                                            NOME: response.data[k].NOME,
                                            CPFCNPJ: response.data[k].CPFCNPJ,
                                            NASCIMENTO: response.data[k].NASCIMENTO == null ? null : response.data[k].NASCIMENTO.split('-').reverse().join('/'),
                                            RATR: response.data[k].RATR,
                                            EMAIL: response.data[k].EMAIL,
                                            TELEFONE: response.data[k].TELEFONE,
                                            TIPOCLIENTE: response.data[k].TIPOCLIENTE,
                                            CEP: response.data[k].CEP,
                                            LOGRADOURO: response.data[k].LOGRADOURO,
                                            NUMERO: response.data[k].NUMERO,
                                            COMPLEMENTO: response.data[k].COMPLEMENTO,
                                            UF: response.data[k].UF,
                                            MUNICIPIO: response.data[k].MUNICIPIO,
                                            BAIRRO: response.data[k].BAIRRO,
                                            MSG: response.data[k].MSG,
                                            DTCADASTRO: response.data[k].DTCADASTRO,
                                            RESPONSAVEL: response.data[k].RESPONSAVEL,
                                            PLACA: response.data[k].PLACA,
                                            CHASSI: response.data[k].CHASSI,
                                            RENAVAN: response.data[k].RENAVAN,
                                            ANOMODELO: response.data[k].ANOMODELO == null ? null : response.data[k].ANOMODELO.split('-').reverse().join('/'),
                                            ANOFAB: response.data[k].ANOFAB == null ? null : response.data[k].ANOFAB.split('-').reverse().join('/'),
                                            PERMISSAO: response.data[k].PERMISSAO,
                                            COMBUSTIVEL: response.data[k].COMBUSTIVEL,
                                            TEMGAS: response.data[k].TEMGAS,
                                            CILINDRO: response.data[k].CILINDRO,
                                            CATEGORIA: response.data[k].CATEGORIA,
                                            ULTIMOLA: response.data[k].ULTIMOLA,
                                            TEMALIENACAO: response.data[k].TEMALIENACAO,
                                            BANCOALIENADO: response.data[k].BANCOALIENADO,
                                            VENCAPOLICE: response.data[k].VENCAPOLICE,
                                            ATUALSEGURADORA: response.data[k].ATUALSEGURADORA,
                                            NOBANCO: response.data[k].NOBANCO,
                                            BANCO: response.data[k].BANCO,
                                            AGENCIA: response.data[k].AGENCIA,
                                            CONTA: response.data[k].CONTA,
                                            TITULAR: response.data[k].TITULAR,
                                            CPFTITULAR: response.data[k].CPFTITULAR,
                                            TIPOCONTA: response.data[k].TIPOCONTA,
                                            TIPOCHAVE: response.data[k].TIPOCHAVE,
                                            CHAVE: response.data[k].CHAVE
                                        })
                                    }

                                    self.isBusyClientes = false

                                    if(self.itemsClientes.length > 0){
                                        self.temCliente = true
                                        self.naoTemCliente = false
                                    }else{
                                        self.temCliente = false
                                        self.naoTemCliente = true
                                    }

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
                    text: 'Distribuição de idades'
                },
                credits: true,
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
                                self.isBusyClientes = true
                                self.temCliente = false
                                self.naoTemCliente = false
                                self.currentPageClientes = 1

                                self.$bvModal.show('modal-tipo-cliente')
                                axios.post('info-birth-chart', {name: e.point.category})
                                .then((response) =>{

                                    self.itemsClientes = []

                                    for(var k=0; k<response.data.length; k++){

                                        self.itemsClientes.push({
                                            CODCLIENTE: response.data[k].CODCLIENTE,
                                            NOME: response.data[k].NOME,
                                            CPFCNPJ: response.data[k].CPFCNPJ,
                                            NASCIMENTO: response.data[k].NASCIMENTO == null ? null : response.data[k].NASCIMENTO.split('-').reverse().join('/'),
                                            RATR: response.data[k].RATR,
                                            EMAIL: response.data[k].EMAIL,
                                            TELEFONE: response.data[k].TELEFONE,
                                            TIPOCLIENTE: response.data[k].TIPOCLIENTE,
                                            CEP: response.data[k].CEP,
                                            LOGRADOURO: response.data[k].LOGRADOURO,
                                            NUMERO: response.data[k].NUMERO,
                                            COMPLEMENTO: response.data[k].COMPLEMENTO,
                                            UF: response.data[k].UF,
                                            MUNICIPIO: response.data[k].MUNICIPIO,
                                            BAIRRO: response.data[k].BAIRRO,
                                            MSG: response.data[k].MSG,
                                            DTCADASTRO: response.data[k].DTCADASTRO,
                                            RESPONSAVEL: response.data[k].RESPONSAVEL,
                                            PLACA: response.data[k].PLACA,
                                            CHASSI: response.data[k].CHASSI,
                                            RENAVAN: response.data[k].RENAVAN,
                                            ANOMODELO: response.data[k].ANOMODELO == null ? null : response.data[k].ANOMODELO.split('-').reverse().join('/'),
                                            ANOFAB: response.data[k].ANOFAB == null ? null : response.data[k].ANOFAB.split('-').reverse().join('/'),
                                            PERMISSAO: response.data[k].PERMISSAO,
                                            COMBUSTIVEL: response.data[k].COMBUSTIVEL,
                                            TEMGAS: response.data[k].TEMGAS,
                                            CILINDRO: response.data[k].CILINDRO,
                                            CATEGORIA: response.data[k].CATEGORIA,
                                            ULTIMOLA: response.data[k].ULTIMOLA,
                                            TEMALIENACAO: response.data[k].TEMALIENACAO,
                                            BANCOALIENADO: response.data[k].BANCOALIENADO,
                                            VENCAPOLICE: response.data[k].VENCAPOLICE,
                                            ATUALSEGURADORA: response.data[k].ATUALSEGURADORA,
                                            NOBANCO: response.data[k].NOBANCO,
                                            BANCO: response.data[k].BANCO,
                                            AGENCIA: response.data[k].AGENCIA,
                                            CONTA: response.data[k].CONTA,
                                            TITULAR: response.data[k].TITULAR,
                                            CPFTITULAR: response.data[k].CPFTITULAR,
                                            TIPOCONTA: response.data[k].TIPOCONTA,
                                            TIPOCHAVE: response.data[k].TIPOCHAVE,
                                            CHAVE: response.data[k].CHAVE
                                        })
                                    }

                                    self.isBusyClientes = false

                                    if(self.itemsClientes.length > 0){
                                        self.temCliente = true
                                        self.naoTemCliente = false
                                    }else{
                                        self.temCliente = false
                                        self.naoTemCliente = true
                                    }

                                }).catch((error)=>{
                                    console.log('error', error);
                                })
                            }
                        }
                    }
                }]
            });
        
            Highcharts.chart('car-category', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Categoria'
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
                        enabled: true
                    },
                    showInLegend: true
                    }
                },
                series: [{
                    name: 'Valor',
                    colorByPoint: true,
                    data: self.dadosCategoria,
                    point: {
                        events: {
                            click: function (e) {
                                self.isBusyClientes = true
                                self.temCliente = false
                                self.naoTemCliente = false
                                self.currentPageClientes = 1
                                self.$bvModal.show('modal-tipo-cliente')
                                axios.post('info-chart-car-category', {name: e.point.name})
                                .then((response) =>{

                                    self.itemsClientes = []

                                    for(var k=0; k<response.data.length; k++){

                                        self.itemsClientes.push({
                                            CODCLIENTE: response.data[k].CODCLIENTE,
                                            NOME: response.data[k].NOME,
                                            CPFCNPJ: response.data[k].CPFCNPJ,
                                            NASCIMENTO: response.data[k].NASCIMENTO == null ? null : response.data[k].NASCIMENTO.split('-').reverse().join('/'),
                                            RATR: response.data[k].RATR,
                                            EMAIL: response.data[k].EMAIL,
                                            TELEFONE: response.data[k].TELEFONE,
                                            TIPOCLIENTE: response.data[k].TIPOCLIENTE,
                                            CEP: response.data[k].CEP,
                                            LOGRADOURO: response.data[k].LOGRADOURO,
                                            NUMERO: response.data[k].NUMERO,
                                            COMPLEMENTO: response.data[k].COMPLEMENTO,
                                            UF: response.data[k].UF,
                                            MUNICIPIO: response.data[k].MUNICIPIO,
                                            BAIRRO: response.data[k].BAIRRO,
                                            MSG: response.data[k].MSG,
                                            DTCADASTRO: response.data[k].DTCADASTRO,
                                            RESPONSAVEL: response.data[k].RESPONSAVEL,
                                            PLACA: response.data[k].PLACA,
                                            CHASSI: response.data[k].CHASSI,
                                            RENAVAN: response.data[k].RENAVAN,
                                            ANOMODELO: response.data[k].ANOMODELO == null ? null : response.data[k].ANOMODELO.split('-').reverse().join('/'),
                                            ANOFAB: response.data[k].ANOFAB == null ? null : response.data[k].ANOFAB.split('-').reverse().join('/'),
                                            PERMISSAO: response.data[k].PERMISSAO,
                                            COMBUSTIVEL: response.data[k].COMBUSTIVEL,
                                            TEMGAS: response.data[k].TEMGAS,
                                            CILINDRO: response.data[k].CILINDRO,
                                            CATEGORIA: response.data[k].CATEGORIA,
                                            ULTIMOLA: response.data[k].ULTIMOLA,
                                            TEMALIENACAO: response.data[k].TEMALIENACAO,
                                            BANCOALIENADO: response.data[k].BANCOALIENADO,
                                            VENCAPOLICE: response.data[k].VENCAPOLICE,
                                            ATUALSEGURADORA: response.data[k].ATUALSEGURADORA,
                                            NOBANCO: response.data[k].NOBANCO,
                                            BANCO: response.data[k].BANCO,
                                            AGENCIA: response.data[k].AGENCIA,
                                            CONTA: response.data[k].CONTA,
                                            TITULAR: response.data[k].TITULAR,
                                            CPFTITULAR: response.data[k].CPFTITULAR,
                                            TIPOCONTA: response.data[k].TIPOCONTA,
                                            TIPOCHAVE: response.data[k].TIPOCHAVE,
                                            CHAVE: response.data[k].CHAVE
                                        })
                                    }

                                    self.isBusyClientes = false

                                    if(self.itemsClientes.length > 0){
                                        self.temCliente = true
                                        self.naoTemCliente = false
                                    }else{
                                        self.temCliente = false
                                        self.naoTemCliente = true
                                    }

                                }).catch((error)=>{
                                    console.log('error', error);
                                })
                            }
                        }
                    }
                }],
                colors: ['#1D5DEC', '#67cb57', '#800080']
            });

            Highcharts.chart('documentation-aliened', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Alienação'
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
                        enabled: true
                    },
                    showInLegend: true
                    }
                },
                series: [{
                    name: 'Valor',
                    colorByPoint: true,
                    data: self.dadosAliencao,
                    point: {
                        events: {
                            click: function (e) {
                                self.isBusyClientes = true
                                self.temCliente = false
                                self.naoTemCliente = false
                                self.currentPageClientes = 1
                                self.$bvModal.show('modal-tipo-cliente')
                                axios.post('info-chart-documentation-aliened', {name: e.point.name})
                                .then((response) =>{

                                    self.itemsClientes = []

                                    for(var k=0; k<response.data.length; k++){

                                        self.itemsClientes.push({
                                            CODCLIENTE: response.data[k].CODCLIENTE,
                                            NOME: response.data[k].NOME,
                                            CPFCNPJ: response.data[k].CPFCNPJ,
                                            NASCIMENTO: response.data[k].NASCIMENTO == null ? null : response.data[k].NASCIMENTO.split('-').reverse().join('/'),
                                            RATR: response.data[k].RATR,
                                            EMAIL: response.data[k].EMAIL,
                                            TELEFONE: response.data[k].TELEFONE,
                                            TIPOCLIENTE: response.data[k].TIPOCLIENTE,
                                            CEP: response.data[k].CEP,
                                            LOGRADOURO: response.data[k].LOGRADOURO,
                                            NUMERO: response.data[k].NUMERO,
                                            COMPLEMENTO: response.data[k].COMPLEMENTO,
                                            UF: response.data[k].UF,
                                            MUNICIPIO: response.data[k].MUNICIPIO,
                                            BAIRRO: response.data[k].BAIRRO,
                                            MSG: response.data[k].MSG,
                                            DTCADASTRO: response.data[k].DTCADASTRO,
                                            RESPONSAVEL: response.data[k].RESPONSAVEL,
                                            PLACA: response.data[k].PLACA,
                                            CHASSI: response.data[k].CHASSI,
                                            RENAVAN: response.data[k].RENAVAN,
                                            ANOMODELO: response.data[k].ANOMODELO == null ? null : response.data[k].ANOMODELO.split('-').reverse().join('/'),
                                            ANOFAB: response.data[k].ANOFAB == null ? null : response.data[k].ANOFAB.split('-').reverse().join('/'),
                                            PERMISSAO: response.data[k].PERMISSAO,
                                            COMBUSTIVEL: response.data[k].COMBUSTIVEL,
                                            TEMGAS: response.data[k].TEMGAS,
                                            CILINDRO: response.data[k].CILINDRO,
                                            CATEGORIA: response.data[k].CATEGORIA,
                                            ULTIMOLA: response.data[k].ULTIMOLA,
                                            TEMALIENACAO: response.data[k].TEMALIENACAO,
                                            BANCOALIENADO: response.data[k].BANCOALIENADO,
                                            VENCAPOLICE: response.data[k].VENCAPOLICE,
                                            ATUALSEGURADORA: response.data[k].ATUALSEGURADORA,
                                            NOBANCO: response.data[k].NOBANCO,
                                            BANCO: response.data[k].BANCO,
                                            AGENCIA: response.data[k].AGENCIA,
                                            CONTA: response.data[k].CONTA,
                                            TITULAR: response.data[k].TITULAR,
                                            CPFTITULAR: response.data[k].CPFTITULAR,
                                            TIPOCONTA: response.data[k].TIPOCONTA,
                                            TIPOCHAVE: response.data[k].TIPOCHAVE,
                                            CHAVE: response.data[k].CHAVE
                                        })
                                    }

                                    self.isBusyClientes = false

                                    if(self.itemsClientes.length > 0){
                                        self.temCliente = true
                                        self.naoTemCliente = false
                                    }else{
                                        self.temCliente = false
                                        self.naoTemCliente = true
                                    }

                                }).catch((error)=>{
                                    console.log('error', error);
                                })
                            }
                        }
                    }
                }],
                colors: ['#7CB06D', '#4B0082']
            });

            Highcharts.chart('vehicle-date', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Tempo de uso'
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
                        enabled: true
                    },
                    showInLegend: true
                    }
                },
                series: [{

                    name: 'Valor',
                    colorByPoint: true,
                    data: self.dadosDataVeiculo,
                    point: {
                        events: {
                            click: function (e) {
                                self.isBusyClientes = true
                                self.temCliente = false
                                self.naoTemCliente = false
                                self.currentPageClientes = 1
                                self.$bvModal.show('modal-tipo-cliente')
                                axios.post('info-chart-vehicle-date', {name: e.point.name})
                                .then((response) =>{

                                    self.itemsClientes = []

                                    for(var k=0; k<response.data.length; k++){

                                        self.itemsClientes.push({
                                            CODCLIENTE: response.data[k].CODCLIENTE,
                                            NOME: response.data[k].NOME,
                                            CPFCNPJ: response.data[k].CPFCNPJ,
                                            NASCIMENTO: response.data[k].NASCIMENTO == null ? null : response.data[k].NASCIMENTO.split('-').reverse().join('/'),
                                            RATR: response.data[k].RATR,
                                            EMAIL: response.data[k].EMAIL,
                                            TELEFONE: response.data[k].TELEFONE,
                                            TIPOCLIENTE: response.data[k].TIPOCLIENTE,
                                            CEP: response.data[k].CEP,
                                            LOGRADOURO: response.data[k].LOGRADOURO,
                                            NUMERO: response.data[k].NUMERO,
                                            COMPLEMENTO: response.data[k].COMPLEMENTO,
                                            UF: response.data[k].UF,
                                            MUNICIPIO: response.data[k].MUNICIPIO,
                                            BAIRRO: response.data[k].BAIRRO,
                                            MSG: response.data[k].MSG,
                                            DTCADASTRO: response.data[k].DTCADASTRO,
                                            RESPONSAVEL: response.data[k].RESPONSAVEL,
                                            PLACA: response.data[k].PLACA,
                                            CHASSI: response.data[k].CHASSI,
                                            RENAVAN: response.data[k].RENAVAN,
                                            ANOMODELO: response.data[k].ANOMODELO == null ? null : response.data[k].ANOMODELO.split('-').reverse().join('/'),
                                            ANOFAB: response.data[k].ANOFAB == null ? null : response.data[k].ANOFAB.split('-').reverse().join('/'),
                                            PERMISSAO: response.data[k].PERMISSAO,
                                            COMBUSTIVEL: response.data[k].COMBUSTIVEL,
                                            TEMGAS: response.data[k].TEMGAS,
                                            CILINDRO: response.data[k].CILINDRO,
                                            CATEGORIA: response.data[k].CATEGORIA,
                                            ULTIMOLA: response.data[k].ULTIMOLA,
                                            TEMALIENACAO: response.data[k].TEMALIENACAO,
                                            BANCOALIENADO: response.data[k].BANCOALIENADO,
                                            VENCAPOLICE: response.data[k].VENCAPOLICE,
                                            ATUALSEGURADORA: response.data[k].ATUALSEGURADORA,
                                            NOBANCO: response.data[k].NOBANCO,
                                            BANCO: response.data[k].BANCO,
                                            AGENCIA: response.data[k].AGENCIA,
                                            CONTA: response.data[k].CONTA,
                                            TITULAR: response.data[k].TITULAR,
                                            CPFTITULAR: response.data[k].CPFTITULAR,
                                            TIPOCONTA: response.data[k].TIPOCONTA,
                                            TIPOCHAVE: response.data[k].TIPOCHAVE,
                                            CHAVE: response.data[k].CHAVE
                                        })
                                    }

                                    self.isBusyClientes = false

                                    if(self.itemsClientes.length > 0){
                                        self.temCliente = true
                                        self.naoTemCliente = false
                                    }else{
                                        self.temCliente = false
                                        self.naoTemCliente = true
                                    }

                                }).catch((error)=>{
                                    console.log('error', error);
                                })
                            }
                        }
                    }
                }],
                colors: ['#E6652D', '#FF0000', '#4C3228', '#808080']
            });
        
             
        })
    },

    selecionaCliente(row){
        let self = this
        
        self.temRegistroSelecionado = true

        self.$bvModal.show('modal-detalhes-registro-selecionado')

        self.nomeSelecionado = row.item.NOME
        self.codClienteSelecionado = row.item.CODCLIENTE
        self.cpfSelecionado = row.item.CPFCNPJ
        self.nascimentoSelecionado = row.item.NASCIMENTO
        self.dataCadastroSelecionado = row.item.DTCADASTRO
        self.tipoClienteSelecionado = row.item.TIPOCLIENTE
        self.ratrSelecionado = row.item.RATR
        self.responsavelSelecionado = row.item.RESPONSAVEL
        self.telefoneSelecionado = row.item.TELEFONE
        self.emailSelecionado = row.item.EMAIL
        self.placaSelecionado = row.item.PLACA
        self.anoFabSelecionado = row.item.ANOFAB
        self.anoModSelecionado = row.item.ANOMODELO
        self.permissaoSelecionado = row.item.PERMISSAO
        self.tipoChaveSelecionado = row.item.TIPOCHAVE
        self.chaveSelecionado = row.item.CHAVE
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
                        <b-tab title="Cadastro" active>
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

                        <b-tab title="Veículo">
                            <b-row class="my-5">
                                <b-col lg="4">
                                    <div id="car-category" class="charts"></div>
                                </b-col>

                                <b-col lg="4">
                                    <div id="documentation-aliened" class="charts"></div>
                                </b-col>

                                <b-col lg="4">
                                    <div id="vehicle-date" class="charts"></div>
                                </b-col>
                            </b-row>
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
                    per-page="5"
                    :current-page="currentPageClientes">
                    <template #table-busy>
                        <div class="text-center text-primary my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Carregando...</strong>
                        </div>
                    </template>

                    <template #cell(acoes)="row">
                        <b-button size="sm" class="m-1 p-1" variant="outline-primary" data-bs-toggle="tooltip" title="Selecionar Cliente" @click="selecionaCliente(row)">
                            <b-icon icon="eye"></b-icon>
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
                        per-page="5"
                        aria-controls="clientes-pessoa-table">
                    </b-pagination>
                </div>
            </div>
        </b-modal>

        <b-modal id="modal-detalhes-registro-selecionado" no-close-on-backdrop hide-footer size="xl" title="Resumo do cliente selecionado">
            <div class="rounded container pt-2" style="border-radius: 0.42rem; border: 1px solid RGBA( 169, 169, 169, 0.4)">
                <fieldset>
                    <h3><b>Dados Pessoais</b></h3>
                    <hr class="w-100 secondary pt-0 mt-0">
                    <b-row class="my-2 mb-3 ml-1 pl-2 pt-2">
                        <b-col lg="2">
                            <label for=""><h6><b>Cód. cliente </b></h6>{{codClienteSelecionado}}</label>
                        </b-col>

                        <b-col lg="4">
                            <label for=""><h6><b>Nome </b></h6>{{nomeSelecionado}}</label>
                        </b-col>

                        <b-col lg="3">
                            <label for=""><h6><b>CPF </b></h6>{{cpfSelecionado}}</label>
                        </b-col>

                        <b-col lg="3">
                            <label for=""><h6><b>Dt. nascimento </b></h6>{{nascimentoSelecionado}}</label>
                        </b-col>
                    </b-row>

                    <hr class="w-100 secondary">

                    <b-row class="my-2 mb-3 ml-1 pl-2">    
                        <b-col lg="1">
                            <label for=""><h6><b>Tipo </b></h6>{{tipoClienteSelecionado}}</label>
                        </b-col>

                        <b-col lg="2">
                            <label for=""><h6><b>Ratr </b></h6>{{ratrSelecionado}}</label>
                        </b-col>

                        <b-col lg="3">
                            <label><h6><b>Telefone </b></h6>{{telefoneSelecionado}}</label>
                        </b-col>

                        <b-col lg="6">
                            <label><h6><b>Email </b></h6>{{emailSelecionado}}</label>
                        </b-col>
                    </b-row>
                </fieldset>
            </div>

            <div class="rounded container mt-3 pt-2" style="border-radius: 0.42rem; border: 1px solid RGBA( 169, 169, 169, 0.4)">
                <fieldset>
                    <h3><b>Dados Veiculares</b></h3>
                    <hr class="w-30 secondary pt-0 mt-0">

                    <b-row class="my-2 mb-3 ml-1 pl-2 pt-2">
                        <b-col lg="3">
                            <label for=""><h6><b>Placa </b></h6>{{placaSelecionado}}</label>
                        </b-col>

                        <b-col lg="3">
                            <label for=""><h6><b>Permissão </b></h6>{{permissaoSelecionado}}</label>
                        </b-col>

                        <b-col lg="3">
                            <label for=""><h6><b>Ano Fab </b></h6>{{anoFabSelecionado}}</label>
                        </b-col>

                        <b-col lg="3">
                            <label for=""><h6><b>Ano Modelo </b></h6>{{anoModSelecionado}}</label>
                        </b-col>
                    </b-row>
                </fieldset>
            </div>

            <div class="rounded container mt-3 pt-2" style="border-radius: 0.42rem; border: 1px solid RGBA( 169, 169, 169, 0.4)">
                <fieldset>
                    <h3><b>Dados Financeiros</b></h3>
                    <hr class="w-30 secondary pt-0 mt-0">

                    <b-row class="my-2 mb-3 ml-1 pl-2 pt-2">
                        <b-col lg="3">
                            <label for=""><h6><b>Tipo chave </b></h6>{{tipoChaveSelecionado}}</label>
                        </b-col>

                        <b-col lg="7">
                            <label for=""><h6><b>Chave PIX </b></h6>{{chaveSelecionado}}</label>
                        </b-col>
                    </b-row>
                </fieldset>
            </div>
        </b-modal>
        
    </div>   
</template>
