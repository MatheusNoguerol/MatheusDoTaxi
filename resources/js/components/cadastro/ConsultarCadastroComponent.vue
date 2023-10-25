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
                        sortabel: true
                    },
                    {
                        key: 'ratr',
                        label: 'RATR',
                        sortabel: true
                    },
                    {
                        key: 'cpf',
                        label: 'CPF',
                        sortabel: true
                    },
                    {
                        key: 'dtNascimento',
                        label: 'Nascimento',
                        sortabel: true
                    },
                    {
                        key: 'dtCadastro',
                        label: 'Dt. cadastro',
                        sortabel: true
                    },
                    {
                        key: 'permissao',
                        label: 'Permissão',
                        sortabel: true
                    },
                    {
                        key: 'placa',
                        label: 'Placa',
                        sortabel: true
                    },
                    {
                        key: 'categoria',
                        label: 'Categoria',
                        sortabel: true
                    },
                ],
                itemsConsultaCliente: [],
                perPageConsultaCliente: 5,
                currentPageConsultaCliente: 1,
                temClienteSelecionado: false,
                temFuncionarioSelecionado: false,

                isBusyTableConsultaFuncionario: false,
                fieldsConsultaFuncionario: [
                    {
                        key: 'nome',
                        label: 'Nome',
                        sortabel: true
                    },
                    {
                        key: 'cpf',
                        label: 'CPF',
                        sortabel: true
                    },
                    {
                        key: 'dtNascimento',
                        label: 'Nascimento',
                        sortabel: true
                    },
                    {
                        key: 'dtCadastro',
                        label: 'Dt. cadastro',
                        sortabel: true
                    },
                ],
                itemsConsultaFuncionario: [],
                perPageConsultaFuncionario: 5,
                currentPageConsultaFuncionario: 1,
                temFuncionarioSelecionado: false,
            }
        },

        computed: {
            rowsConsultaCliente() {
                return this.length.itemsConsultaCliente
            },

            rowsConsultaFuncionario() {
                return this.length.itemsConsultaFuncionario
            },

            arrayBusca() {
            let self = this
            return [{
                tipoConsulta: this.tipoConsulta,
                pesquisaCliente: this.pesquisaCliente,
                pesquisaFuncionario: this.pesquisaFuncionario,
                nomeConsulta: this.nomeConsulta,
                dtCadastroDe: this.dtCadastroDe,
                dtCadastroAte: this.dtCadastroAte,
                ratrConsulta: this.ratrConsulta,
                cpfConsulta: this.cpfConsulta,
                dtNascimentoDe: this.dtNascimentoDe,
                dtNascimentoAte: this.dtNascimentoAte,
                permissaoConsulta: this.permissaoConsulta,
                placaConsulta: this.placaConsulta,
                categoriaConsulta: this.categoriaConsulta
            }]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            consultar(){
                let self = this
                if(self.tipoConsulta == 'cliente'){

                    axios.post('consulta-cadastro-cliente',{arrayBusca: self.arrayBusca})
                    .then((response)=> {
                        console.log('Response:', response.data)
                        if(response.data.ref == 0){
                            for(var t = 0 ; t < response.data.length ; t++){
                                // self.itemsConsultaCliente.push({
                                //     nome: response.data[t].,
                                //     ratr: response.data.,
                                //     cpf: response.data.,
                                //     dtNascimento: response.data.,
                                //     dtCadastro: response.data.,
                                //     permissao: response.data.,
                                //     placa: response.data.,
                                //     categoria: response.data.,
                                // })
                            }
                            
                        }
                    }).catch((error) => {
                        console.log('Error:', error)
                    })

                }else{

                }
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
                    <b-form-select :options="optionsPesquisaCliente" type="text" id="tipoVeiculo" v-model="pesquisaCliente" v-if="tipoConsulta == 'cliente'"></b-form-select>
                    <b-form-select :options="optionsPesquisaFuncionario" type="text" id="tipoVeiculo" v-model="pesquisaFuncionario" v-if="tipoConsulta == 'funcionario'"></b-form-select>
                </b-col>

                <b-col lg="5" v-if="this.pesquisaCliente == 'nome' || this.pesquisaFuncionario == 'nome'" class="pt-1">
                    <label for="nomeConsulta"></label>
                    <b-form-input v-model="nomeConsulta" type="text" id="nomeConsulta"></b-form-input>
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
                    <b-button variant="primary" v-if="tipoConsulta != '' && (this.optionsPesquisaCliente != null || this.optionsPesquisaFuncionario != null)" @click="consultar()">Consultar</b-button>
                </b-col>
            </b-row>

            <hr variant="primary">

            <b-row v-if="temClienteSelecionado == true">

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
                        <b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Selecionar" variant="outline-primary" @click.prevent="selecionaCliente(row)">
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
        </div>
    </div>
</template>
