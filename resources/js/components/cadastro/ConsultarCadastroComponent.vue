<script>
    export default {
        data(){
            return{
                nomeConsulta: null,
                tipoVeiculoOptions: [
                    {text: 'Táxi', value: 'taxi'},
                    {text: 'Particular', value: 'particular'}
                ],
                tipoVeiculo: null,
                optionsConsulta: [
                    { item: 'cliente', name: 'Cliente' },
                    { item: 'funcionario', name: 'Funcionário' },
                ],
                tipoConsulta: null,
                ratrConsulta: null,
                cpfConsulta: null,
                optionsPesquisaCliente: [
                    { text: 'Nome', value: 'nome' },
                    { text: 'Ratr', value: 'ratr' },
                    { text: 'CPF', value: 'cpf' },
                    { text: 'Nascimento', value: 'dtNascimento' },
                    { text: 'Data Cadastro', value: 'dtCadastro' },
                    { text: 'Permissão', value: 'permissao' },
                    { text: 'Placa', value: 'placa' },
                    { text: 'Categoria', value: 'categoria' },

                ],
                optionsPesquisaFuncionario: [
                    { text: 'Nome', value: 'nome' },
                    { text: 'CPF', value: 'cpf' },
                    { text: 'Nascimento', value: 'dtNascimento' },
                    { text: 'Data Cadastro', value: 'dtCadastro' },

                ],
                pesquisaCliente: null,
                pesquisaFuncionario: null,
                dtCadastroDe: null,
                dtCadastroAte: null,
                dtNascimentoDe: null,
                dtNascimentoAte: null,
                permissaoConsulta: null,
                placaConsulta: null,
                categoriaConsulta: null,
                optionsCategoria: [
                    {text: 'Táxi', value: 'taxi'},
                    {text: 'Particular', value: 'particular'}
                ],
                isBusyTableConsultaCliente: false,
                fieldsConsultaCliente: [
                    {
                        key: 'nome',
                        label: 'Nome',
                        sortable: true
                    },
                    {
                        key: 'ratr',
                        label: 'RATR',
                        sortable: true
                    },
                    {
                        key: 'cpfCnpj',
                        label: 'CPF',
                        sortable: true
                    },
                    {
                        key: 'nascimento',
                        label: 'Nascimento',
                        sortable: true
                    },
                    {
                        key: 'dtCadastro',
                        label: 'Dt. cadastro',
                        sortable: true
                    },
                    {
                        key: 'permissao',
                        label: 'Permissão',
                        sortable: true
                    },
                    {
                        key: 'placa',
                        label: 'Placa',
                        sortable: true
                    },
                    {
                        key: 'categoria',
                        label: 'Categoria',
                        sortable: true
                    },
                    {
                        key: 'acoes',
                        label: 'Visualizar',
                        sortable: true
                    },
                ],
                itemsConsultaCliente: [],
                perPageConsultaCliente: 5,
                currentPageConsultaCliente: 1,
                temCliente: false,
                temFuncionarioSelecionado: false,

                isBusyTableConsultaFuncionario: false,
                fieldsConsultaFuncionario: [
                    {
                        key: 'nome',
                        label: 'Nome',
                        sortable: true
                    },
                    {
                        key: 'cpf',
                        label: 'CPF',
                        sortable: true
                    },
                    {
                        key: 'dtNascimento',
                        label: 'Nascimento',
                        sortable: true
                    },
                    {
                        key: 'dtCadastro',
                        label: 'Dt. cadastro',
                        sortable: true
                    },
                ],
                itemsConsultaFuncionario: [],
                perPageConsultaFuncionario: 5,
                currentPageConsultaFuncionario: 1,
                temFuncionarioSelecionado: false,
                hoje: null,
                modalInfoCadastro: false,
                codClienteSelecionado: null,
                nomeSelecionado: null,
                cpfCnpjSelecionado: null,
                nascimentoSelecionado: null,
                ratrSelecionado: null,
                emailSelecionado: null,
                telefoneSelecionado: null,
                tipoClienteSelecionado: null,
                dtCadastroSelecionado: null,
                cepSelecionado: null,
                logradouroSelecionado: null,
                numeroSelecionado: null,
                complementoSelecionado: null,
                ufSelecionado: null,
                municipioSelecionado: null,
                bairroSelecionado: null,
                msgSelecionado: null,
                placaSelecionado: null,
                permissaoSelecionado: null,
                renavanSelecionado: null,
                chassiSelecionado: null,
                anoModelo: null,
                anoFab: null,
                combustivel: null,
                possuiGnv: null,
                gnv: null,
                categoria: null,
                possuiAlienacaoSelecionado: null,
                bancoAlienadoSelecionado: null,
                ultimoLaSelecionado: null,
                atualSeguradoraSelecionado: null,
                nmrbancoSelecionado: null,
                bancoSelecionado: null,
                agenciaSelecionado: null,
                contaSelecionado: null,
                titularSelecionado: null,
                cpfTitularSelecionado: null,
                tipoContaSelecionado: null,
                tipoChaveSelecionado: null,
                chaveSelecionado: null,
            }
        },

        computed: {
            rowsConsultaCliente() {
                return this.itemsConsultaCliente.length
            },

            arrayBusca() {
                let self = this
                return [{
                    tipoConsulta: self.tipoConsulta,
                    pesquisaCliente: self.pesquisaCliente,
                    pesquisaFuncionario: self.pesquisaFuncionario,
                    nomeConsulta: self.nomeConsulta,
                    dtCadastroDe: self.dtCadastroDe,
                    dtCadastroAte: self.dtCadastroAte,
                    ratrConsulta: self.ratrConsulta,
                    cpfConsulta: self.cpfConsulta,
                    dtNascimentoDe: self.dtNascimentoDe,
                    dtNascimentoAte: self.dtNascimentoAte,
                    permissaoConsulta: self.permissaoConsulta,
                    placaConsulta: self.placaConsulta,
                    categoriaConsulta: self.categoriaConsulta,
                }]
            }
        },
        mounted() {
            let self = this
            console.log('Component mounted.')

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
            self.dtCadastroAte = formatDate(today)
            self.dtNascimentoAte = formatDate(today)
        },
        methods:{
            consultar(){
                let self = this

                if(self.tipoConsulta == 'cliente'){
                    if(self.pesquisaCliente == null || self.pesquisaCliente == ''){
                        toastr.warning('Selecione o tipo de pesquisa por cliente.', 'Atenção!', {timeout: 3000, progressBar: true})
                    }else{
                        self.itemsConsultaCliente = []
                        self.isBusyTableConsultaCliente = true
                        axios.post('consulta-cadastro-cliente',{arrayBusca: self.arrayBusca})
                        .then((response)=> {
    
                            if(self.pesquisaCliente == 'nome'){

                                if(response.data.error == 1){
                                    toastr.warning('Nome não encontrado na base de dados.', 'Atenção!', {timeout: 3000, progesseBar: true})
                                    self.nomeConsulta = null
                                    $("input#nome").addClass('modal-primary-focus').focus()
                                    self.isBusyTableConsultaCliente = false
                                }else {
                                    console.log('response: ', response.data)
                                    for(var t = 0 ; t < response.data.length ; t++){

                                        self.itemsConsultaCliente.push({
                                            agencia: response.data[t].AGENCIA,
                                            anoFab: response.data[t].ANOFAB,
                                            anoModelo: response.data[t].ANOMODELO,
                                            atualSeguradora: response.data[t].ATUALSEGURADORA,
                                            bairro: response.data[t].BAIRRO,
                                            banco: response.data[t].BANCO,
                                            bancoAlienado: response.data[t].BANCOALIENADO,
                                            categoria: response.data[t].CATEGORIA,
                                            cep: response.data[t].CEP,
                                            chassi: response.data[t].CHASSI,
                                            chave: response.data[t].CHAVE,
                                            cilindro: response.data[t].CILINDRO,
                                            codCliente: response.data[t].CODCLIENTE,
                                            combustivel: response.data[t].COMBUSTIVEL,
                                            complemento: response.data[t].COMPLEMENTO,
                                            conta: response.data[t].CONTA,
                                            cpfCnpj: response.data[t].CPFCNPJ,
                                            cpfTitular: response.data[t].cpfTitular,
                                            dtCadastro: response.data[t].DTCADASTRO == null ? null : response.data[t].DTCADASTRO.split('-').reverse().join('/'),
                                            email: response.data[t].EMAIL,
                                            id: response.data[t].ID,
                                            logradouro: response.data[t].LOGRADOURO,
                                            msg: response.data[t].MSG,
                                            municipio: response.data[t].MUNICIPIO,
                                            nascimento: response.data[t].NASCIMENTO == null ? null : response.data[t].NASCIMENTO.split('-').reverse().join('/'),
                                            noBanco: response.data[t].NOBANCO,
                                            nome: response.data[t].NOME,
                                            numero: response.data[t].NUMERO,
                                            permissao: response.data[t].PERMISSAO,
                                            placa: response.data[t].PLACA,
                                            ratr: response.data[t].RATR,
                                            renavan: response.data[t].RENAVAN,
                                            responsavel: response.data[t].RESPONSAVEL,
                                            telefone: response.data[t].TELEFONE,
                                            temAlienacao: response.data[t].TEMALIENACAO,
                                            temGas: response.data[t].TEMGAS,
                                            tipoChave: response.data[t].TIPOCHAVE,
                                            tipoCliente: response.data[t].TIPOCLIENTE,
                                            tipoConta: response.data[t].TIPOCONTA,
                                            titular: response.data[t].TITULAR,
                                            uf: response.data[t].UF,
                                            ultimoLa: response.data[t].ULTIMOLA,
                                            vencApolice: response.data[t].VENCAPOLICE == null ? null : response.data[t].VENCAPOLICE.split('-').reverse().join('/'),
                                        })

                                    }
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false

                                    console.log('aqui: ', self.itemsConsultaCliente)
    
                                }
    
                            }else if(self.pesquisaCliente == 'ratr'){

                                if(response.data.error == 1){
                                    toastr.warning('RATR não encontrado na base de dados.', 'Atenção!', {timeout: 3000, progesseBar: true})
                                    self.ratrConsulta = null
                                    $("input#ratrConsulta").addClass('modal-primary-focus').focus()
                                    self.isBusyTableConsultaCliente = false
                                }else{
                                    self.itemsConsultaCliente.push({
                                        nome: response.data[0].NOME,
                                        ratr: response.data[0].RATR,
                                        cpf: response.data[0].CPFCNPJ,
                                        dtNascimento: response.data[0].NASCIMENTO == null ? response.data[0].NASCIMENTO : response.data[0].NASCIMENTO.split('-').reverse().join('/'),
                                        dtCadastro: response.data[0].DTCADASTRO == null ? response.data[0].DTCADASTRO : response.data[0].DTCADASTRO.split('-').reverse().join('/'),
                                        permissao: response.data[0].PERMISSAO,
                                        placa: response.data[0].PLACA,
                                        categoria: response.data[0].CATEGORIA,
                                    })
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }

                            }else if(self.pesquisaCliente == 'cpf'){

                                if(response.data.error == 1){
                                    toastr.warning('CPF não encontrado na base de dados.', 'Atenção!', {timeout: 3000, progesseBar: true})
                                    self.cpfConsulta = null
                                    $("input#cpfConsulta").addClass('modal-primary-focus').focus()
                                    self.isBusyTableConsultaCliente = false
                                }else{

                                    self.itemsConsultaCliente.push({
                                        nome: response.data[0].NOME,
                                        ratr: response.data[0].RATR == null ? null : response.data[0].RATR,
                                        cpf: response.data[0].CPFCNPJ,
                                        dtNascimento: response.data[0].NASCIMENTO == null ? response.data[0].NASCIMENTO : response.data[0].NASCIMENTO.split('-').reverse().join('/'),
                                        dtCadastro: response.data[0].DTCADASTRO == null ? response.data[0].DTCADASTRO : response.data[0].DTCADASTRO.split('-').reverse().join('/'),
                                        permissao: response.data[0].PERMISSAO == null ? null : response.data[0].PERMISSAO,
                                        placa: response.data[0].PLACA == null ? null : response.data[0].PLACA,
                                        categoria: response.data[0].CATEGORIA == null ? null : response.data[0].CATEGORIA,
                                    })

                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }

                            }else if(self.pesquisaCliente == 'dtNascimento'){

                                if(response.data.error == 1){
                                    toastr.warning('Não há registro no período selecionado.','Atenção!', {timeOut: 3000, progresseBar: true})
                                    self.dtNascimentoDe = null
                                    self.dtNascimentoAte = null
                                    $("input#dtNascimentoDe").addClass('modal-primary-focus').focus()
                                    self.isBusyTableConsultaCliente = false
                                }else{

                                    for(var r = 0 ; r < response.data.length ; r++){
                                        self.itemsConsultaCliente.push({
                                            nome: response.data[r].NOME,
                                            ratr: response.data[r].RATR,
                                            cpf: response.data[r].CPFCNPJ,
                                            dtNascimento: response.data[r].NASCIMENTO == null ? response.data[r].NASCIMENTO : response.data[r].NASCIMENTO.split('-').reverse().join('/'),
                                            dtCadastro: response.data[r].DTCADASTRO == null ? response.data[r].DTCADASTRO : response.data[r].DTCADASTRO.split('-').reverse().join('/'),
                                            permissao: response.data[r].PERMISSAO,
                                            placa: response.data[r].PLACA,
                                            categoria: response.data[r].CATEGORIA,
                                        })
                                    }
    
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }

                            }else if(self.pesquisaCliente == 'dtCadastro'){

                                if(response.data.error == 1){
                                    toastr.warning('Não há registro no período selecionado.','Atenção!', {timeOut: 3000, progresseBar: true})
                                    self.isBusyTableConsultaCliente = false
                                }else{

                                    for(var r = 0 ; r < response.data.length ; r++){
                                        self.itemsConsultaCliente.push({
                                            nome: response.data[r].NOME,
                                            ratr: response.data[r].RATR,
                                            cpf: response.data[r].CPFCNPJ,
                                            dtNascimento: response.data[r].NASCIMENTO == null ? response.data[r].NASCIMENTO : response.data[r].NASCIMENTO.split('-').reverse().join('/'),
                                            dtCadastro: response.data[r].DTCADASTRO == null ? response.data[r].DTCADASTRO : response.data[r].DTCADASTRO.split('-').reverse().join('/'),
                                            permissao: response.data[r].PERMISSAO,
                                            placa: response.data[r].PLACA,
                                            categoria: response.data[r].CATEGORIA,
                                        })
                                    }
    
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }

                            }else if(self.pesquisaCliente == 'permissao'){

                                if(response.data.error == 1){
                                    toastr.warning('Não existe essa permissao na base de dados.','Atenção!', {timeOut: 3000, progresseBar: true})
                                    self.isBusyTableConsultaCliente = false
                                }else{

                                    for(var r = 0 ; r < response.data.length ; r++){
                                        self.itemsConsultaCliente.push({
                                            nome: response.data[r].NOME,
                                            ratr: response.data[r].RATR,
                                            cpf: response.data[r].CPFCNPJ,
                                            dtNascimento: response.data[r].NASCIMENTO == null ? response.data[r].NASCIMENTO : response.data[r].NASCIMENTO.split('-').reverse().join('/'),
                                            dtCadastro: response.data[r].DTCADASTRO == null ? response.data[r].DTCADASTRO : response.data[r].DTCADASTRO.split('-').reverse().join('/'),
                                            permissao: response.data[r].PERMISSAO,
                                            placa: response.data[r].PLACA,
                                            categoria: response.data[r].CATEGORIA,
                                        })
                                    }
    
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }
                                
                            }else if(self.pesquisaCliente == 'placa'){

                                if(response.data.error == 1){
                                    toastr.warning('Não existe essa placa na base de dados.','Atenção!', {timeOut: 3000, progresseBar: true})
                                    self.isBusyTableConsultaCliente = false
                                    self.placaConsulta = null
                                }else{

                                    for(var r = 0 ; r < response.data.length ; r++){
                                        self.itemsConsultaCliente.push({
                                            nome: response.data[r].NOME,
                                            ratr: response.data[r].RATR,
                                            cpf: response.data[r].CPFCNPJ,
                                            dtNascimento: response.data[r].NASCIMENTO == null ? response.data[r].NASCIMENTO : response.data[r].NASCIMENTO.split('-').reverse().join('/'),
                                            dtCadastro: response.data[r].DTCADASTRO == null ? response.data[r].DTCADASTRO : response.data[r].DTCADASTRO.split('-').reverse().join('/'),
                                            permissao: response.data[r].PERMISSAO,
                                            placa: response.data[r].PLACA,
                                            categoria: response.data[r].CATEGORIA,
                                        })
                                    }
    
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }
                                
                            }else if(self.pesquisaCliente == 'categoria'){

                                if(response.data.error == 1){
                                    toastr.warning('Não existe cadastros nessa categoria.','Atenção!', {timeOut: 3000, progresseBar: true})
                                    self.isBusyTableConsultaCliente = false
                                    self.categoriaConsulta = null
                                }else{

                                    for(var r = 0 ; r < response.data.length ; r++){
                                        self.itemsConsultaCliente.push({
                                            nome: response.data[r].NOME,
                                            ratr: response.data[r].RATR,
                                            cpf: response.data[r].CPFCNPJ,
                                            dtNascimento: response.data[r].NASCIMENTO == null ? response.data[r].NASCIMENTO : response.data[r].NASCIMENTO.split('-').reverse().join('/'),
                                            dtCadastro: response.data[r].DTCADASTRO == null ? response.data[r].DTCADASTRO : response.data[r].DTCADASTRO.split('-').reverse().join('/'),
                                            permissao: response.data[r].PERMISSAO,
                                            placa: response.data[r].PLACA,
                                            categoria: response.data[r].CATEGORIA,
                                        })
                                    }
    
                                    self.temCliente = true
                                    self.isBusyTableConsultaCliente = false
                                }
                                
                            }

                        }).catch((error) => {
                            console.log('Error:', error)
                        })

                    }

                }else{

                }
                
            },

            selecionaCliente(row){
                let self = this

                console.log('row:', row.item)



                self.codClienteSelecionado = row.item.codCliente
                self.nomeSelecionado = row.item.nome
                self.cpfCnpjSelecionado = row.item.cpfCnpj
                self.nascimentoSelecionado = row.item.nascimento
                self.ratrSelecionado = row.item.ratr
                self.emailSelecionado = row.item.email
                self.telefoneSelecionado = row.item.telefone
                self.tipoClienteSelecionado = row.item.tipoCliente
                self.dtCadastroSelecionado = row.item.dtCadastro
                self.cepSelecionado = row.item.cep
                self.logradouroSelecionado = row.item.logradouro
                self.numeroSelecionado = row.item.numero
                self.complementoSelecionado = row.item.complemento
                self.ufSelecionado = row.item.uf
                self.municipioSelecionado = row.item.municipio
                self.bairroSelecionado = row.item.bairro
                self.msgSelecionado = row.item.msg
                self.placaSelecionado = row.item.placa
                self.permissaoSelecionado = row.item.permissao
                self.renavanSelecionado = row.item.renavan
                self.chassiSelecionado = row.item.chassi
                self.anoModelo = row.item.anoModelo
                self.anoFab = row.item.anoFab
                self.combustivel = row.item.combustivel
                self.possuiGnv = row.item.temGas
                self.gnv = row.item.cilindro
                self.categoria = row.item.categoria
                self.possuiAlienacaoSelecionado = row.item.temAlienacao
                self.bancoAlienadoSelecionado = row.item.bancoAlienado
                self.ultimoLaSelecionado = row.item.ultimoLa
                self.atualSeguradoraSelecionado = row.item.atualSeguradora
                self.nmrbancoSelecionado = row.item.noBanco
                self.bancoSelecionado = row.item.banco
                self.agenciaSelecionado = row.item.agencia
                self.contaSelecionado = row.item.conta
                self.titularSelecionado = row.item.titular
                self.cpfTitularSelecionado = row.item.cpfTitular
                self.tipoContaSelecionado = row.item.tipoConta
                self.tipoChaveSelecionado = row.item.tipoChave
                self.chaveSelecionado = row.item.chave
            },

            limpaConsulta(){
                let self = this

                self.nomeConsulta = null
                self.dtCadastroDe = null
                self.dtCadastroAte = null
                self.ratrConsulta = null
                self.cpfConsulta = null
                self.dtNascimentoDe = null
                self.dtNascimentoAte = null
                self.permissaoConsulta = null
                self.placaConsulta = null
                self.categoriaConsulta = null
                self.itemsConsultaCliente = []
                self.tipoConsulta = null
                self.isBusyTableConsultaCliente = false
                self.isBusyTableConsultaFuncionario = false
                self.temCliente = false
            },

            limpaInput(){
                let self = this 

                self.nomeConsulta = null
                self.dtCadastroDe = null
                self.dtCadastroAte = self.hoje
                self.ratrConsulta = null
                self.cpfConsulta = null
                self.dtNascimentoDe = null
                self.dtNascimentoAte = self.hoje
                self.permissaoConsulta = null
                self.placaConsulta = null
                self.categoriaConsulta = null

            }
        }
    }
</script>


<template>  
    <div>
        <h1 class="text-center">Consultar Cadastros</h1>

        <div style="background-color: white; border-radius: 5px;" class="m-2 p-2">
            <b-row class="m-2">

                <b-col>
                    <label for=""><b>Selecione o tipo da consulta</b></label>
                </b-col>

            </b-row>

            <b-row class="m-2">

                <b-col>
                    <b-form-radio-group
                    v-model="tipoConsulta"
                    :options="optionsConsulta"
                    class="mb-3"
                    value-field="item"
                    text-field="name"
                    ></b-form-radio-group>
                </b-col>

            </b-row>

            <b-row class="m-2" v-if="tipoConsulta != null" id="consulta">

                <b-col lg="2" class="mt-1">
                    <label for=""></label>
                    <b-form-select :options="optionsPesquisaCliente" @change="limpaInput()" type="text" id="tipoVeiculo" v-model="pesquisaCliente" v-if="tipoConsulta == 'cliente'"></b-form-select>
                    <b-form-select :options="optionsPesquisaFuncionario" type="text" id="tipoVeiculo" v-model="pesquisaFuncionario" v-if="tipoConsulta == 'funcionario'"></b-form-select>
                </b-col>

                <b-col lg="5" v-if="this.pesquisaCliente == 'nome' || this.pesquisaFuncionario == 'nome'" class="pt-1">
                    <label for="nome"></label>
                    <b-form-input v-model="nomeConsulta" name="nome" type="text" id="nome"></b-form-input>
                </b-col>

                <b-col lg="2" v-if="this.pesquisaCliente == 'dtCadastro' || this.pesquisaFuncionario == 'dtCadastro'"> 
                    <label for="dtCadastroDe">DE</label>
                    <b-form-input type="date" id="dtCadastroDe" v-model="dtCadastroDe" name="dtCadastroDe" max="9999-12-31"></b-form-input>
                </b-col>

                <b-col lg="2" v-if="this.pesquisaCliente == 'dtCadastro' || this.pesquisaFuncionario == 'dtCadastro'"> 
                    <label for="dtCadastroAte">ATÉ</label>
                    <b-form-input type="date" id="dtCadastroAte" v-model="dtCadastroAte" name="dtCadastroAte" max="9999-12-31"></b-form-input>
                </b-col>
                  
                <b-col lg="4" v-if="tipoConsulta == 'cliente' && this.pesquisaCliente == 'ratr'" class="pt-1">
                    <label class="form-label"></label>
                    <b-form-input class="form-control" type="text" id="ratrConsulta" v-model="ratrConsulta"></b-form-input>
                </b-col>

                <b-col lg="3" v-if="this.pesquisaCliente == 'cpf' || this.pesquisaFuncionario == 'cpf'" class="pt-1">
                    <label></label>
                    <b-form-input type="text" id="cpfConsulta" v-model="cpfConsulta" v-mask="'###.###.###-##'"></b-form-input>
                </b-col>

                <b-col lg="2" v-if="this.pesquisaCliente == 'dtNascimento' || this.pesquisaFuncionario == 'dtNascimento'"> 
                    <label for="dtNascimentoDe">DE</label>
                    <b-form-input type="date" id="dtNascimentoDe" v-model="dtNascimentoDe" name="dtNascimentoDe" max="9999-12-31"></b-form-input>
                </b-col>

                <b-col lg="2" v-if="this.pesquisaCliente == 'dtNascimento' || this.pesquisaFuncionario == 'dtNascimento'"> 
                    <label for="dtNascimentoAte">ATÉ</label>
                    <b-form-input type="date" id="dtNascimentoAte" v-model="dtNascimentoAte" name="dtNascimentoAte" max="9999-12-31"></b-form-input>
                </b-col>

                <b-col lg="3" v-if="tipoConsulta == 'cliente' && this.pesquisaCliente == 'permissao'" class="pt-1">
                    <label class="form-label"></label>
                    <b-form-input class="form-control" type="text" id="permissaoConsulta" v-model="permissaoConsulta" v-mask="'##.######-#'"></b-form-input>
                </b-col>

                <b-col lg="3" v-if="tipoConsulta == 'cliente' && this.pesquisaCliente == 'placa'" class="pt-1">
                    <label class="form-label"></label>
                    <b-form-input class="form-control" type="text" id="placaConsulta" v-model="placaConsulta"></b-form-input>
                </b-col>

                <b-col lg="2" v-if="tipoConsulta == 'cliente' && this.pesquisaCliente == 'categoria'" class="pt-1">
                    <label class="form-label"></label>
                    <b-form-select class="form-control" type="text" id="categoriaConsulta" v-model="categoriaConsulta" :options="optionsCategoria"></b-form-select>
                </b-col>
                
            </b-row>

            <b-row class="m-2 justify-content-end">
                <b-col lg="3">
                    <b-button variant="primary" v-if="tipoConsulta != null" @click="consultar()">Consultar</b-button>
                    <b-button variant="primary" v-if="this.itemsConsultaCliente.length != 0" @click="limpaConsulta()">Limpar</b-button>
                </b-col>
            </b-row>

            <hr variant="primary">

            <b-row v-if="temCliente == true">

                <div class="col-lg-12">
                    <b-table hover outlined responsive
                        id="consulta-cliente"
                        head-variant="primary"
                        :busy="isBusyTableConsultaCliente"
                        :fields="fieldsConsultaCliente"
                        :items="itemsConsultaCliente"
                        :per-page="perPageConsultaCliente"
                        :current-page="currentPageConsultaCliente">
                        <template #table-busy>
                        <div class="text-center text-primary my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Carregando...</strong>
                        </div>
                        </template>

                        <template #cell(acoes)="row">
                            <b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Visualizar cadastro" variant="outline-primary" v-b-modal.modal-info-cadastro @click.prevent="selecionaCliente(row)">
                                <b-icon icon="eye"></b-icon>
                            </b-button>
                        </template>
                    </b-table>
                </div> 
                <div class="col col-lg-12 mt-0 pt-0">
                    <div class="justify-content-end d-flex mt-0 pt-0">
                        <small class="text-muted mt-0 pt-0"><p>{{rowsConsultaCliente}} registros encontrados.</p></small>
                    </div>
                </div>
                <div class="col col-lg-12 mt-1">
                    <div class="justify-content-center d-flex">
                        <b-pagination
                        align="center"
                        v-model="currentPageConsultaCliente"
                        :total-rows="rowsConsultaCliente"
                        :per-page="perPageConsultaCliente"
                        aria-controls="lista-clientes"
                        >
                        </b-pagination>
                    </div>
                </div>

            </b-row>

            <b-row v-if="temFuncionarioSelecionado == true">

                <div class="col-lg-12">
                    <b-table hover outlined responsive
                        id="consulta-funcionario"
                        head-variant="primary"
                        :busy="isBusyTableConsultaFuncionario"
                        :fields="fieldsConsultaFuncionario"
                        :items="itemsConsultaFuncionario"
                        :per-page="perPageConsultaFuncionario"
                        :current-page="currentPageConsultaFuncionario">
                        <template #table-busy>
                        <div class="text-center text-primary my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Carregando...</strong>
                        </div>
                        </template>

                        <template #cell(acoes)="row">
                        <b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Selecionar" variant="outline-primary" @click.prevent="selecionaFuncionario(row)">
                            <b-icon icon="eye"></b-icon>
                        </b-button>
                        </template>
                    </b-table>
                </div> 
                <div class="col col-lg-12 mt-0 pt-0">
                    <div class="justify-content-end d-flex mt-0 pt-0">
                        <small class="text-muted mt-0 pt-0"><p>{{rowsConsultaFuncionario}} registros encontrados.</p></small>
                    </div>
                </div>
                <div class="col col-lg-12 mt-1">
                    <div class="justify-content-center d-flex">
                        <b-pagination
                        align="center"
                        v-model="currentPageConsultaFuncionario"
                        :total-rows="rowsConsultaFuncionario"
                        :per-page="perPageConsultaFuncionario"
                        aria-controls="consulta-funcionario"
                        >
                        </b-pagination>
                    </div>
                </div>

            </b-row>

            <b-modal id="modal-info-cadastro" size="xl" hide-footer no-close-on-backdrop no-close-on-esc v-model="modalInfoCadastro" title="Detalhes do cadastro">

                <h4 class="text-primary">Dados Pessoais</h4>
                <hr class="w-100 mt-0 mb-2 bg-primary">
                
                <b-row class="my-2 ml-1 pl-2">
                    <b-col lg="2">
                        <label for=""><b>Código Cliente: </b>{{codClienteSelecionado}}</label>
                    </b-col>

                    <b-col lg="6">
                        <label for=""><b>Nome: </b>{{nomeSelecionado}}</label>
                    </b-col>

                    <b-col lg="4">
                        <label for=""><b>Email: </b>{{emailSelecionado}}</label>
                    </b-col>
                </b-row>
                <b-row class="my-2 ml-1 pl-2"> 
                    <b-col lg="3"> 
                        <label for=""><b>CPF: </b>{{cpfCnpjSelecionado}}</label>
                    </b-col>

                    <b-col lg="3">
                        <label for=""><b>Data Nascimento: </b>{{nascimentoSelecionado}}</label>
                    </b-col>

                    <b-col lg="3">
                        <label for=""><b>Data Cadastro: </b>{{dtCadastroSelecionado}}</label>
                    </b-col>

                    <b-col lg="2">
                        <label for=""><b>RATR: </b>{{ratrSelecionado}}</label>
                    </b-col>
                </b-row>

                <b-row class="my-2 ml-1 pl-2">
                    <b-col lg="3">
                        <label for=""><b>Telefone: </b>{{telefoneSelecionado}}</label>
                    </b-col>
                    
                    <b-col lg="2">
                        <label for=""><b>Tipo Cliente: </b>{{tipoClienteSelecionado}}</label>
                    </b-col>
                </b-row>

                <h4 class="text-primary">Endereço</h4>
                <hr class="w-100 mt-0 mb-2 bg-primary">

                <b-row class="my-2 ml-1 pl-2">
                    <b-col lg="2">
                        <label for=""><b>CEP: </b>{{cepSelecionado}}</label>
                    </b-col>

                    <b-col lg="5">
                        <label for=""><b>Logradouro: </b>{{logradouroSelecionado}}</label>
                    </b-col>

                    <b-col lg="2">
                        <label for=""><b>Número: </b>{{numeroSelecionado}}</label>
                    </b-col>
                </b-row>
                <b-row class="my-2 ml-1 pl-2">
                    <b-col lg="3">
                        <label for=""><b>Complemento: </b>{{complementoSelecionado}}</label>
                    </b-col>

                    <b-col lg="2">
                        <label for=""><b>UF: </b>{{ufSelecionado}}</label>
                    </b-col>

                    <b-col lg="3">
                        <label for=""><b>Município: </b>{{municipioSelecionado}}</label>
                    </b-col>

                    <b-col lg="4">
                        <label for=""><b>Bairro: </b>{{bairroSelecionado}}</label>
                    </b-col>
                </b-row>
                <b-row class="my-2 ml-1 pl-2">
                    <b-col>
                        <label for=""><b>OBS: </b>{{msgSelecionado}}</label>
                    </b-col>
                </b-row>
            </b-modal>  
        </div>
    </div>
</template>
