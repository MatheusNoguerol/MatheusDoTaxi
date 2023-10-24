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
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{

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
                    <b-form-input class="form-control" type="text" id="placaConsulta" v-model="placaConsulta" v-mask="'###-###'"></b-form-input>
                </b-col>

                <b-col lg="2" v-if="tipoConsulta == 'cliente' && this.pesquisaCliente == 'categoria'" class="pt-1">
                    <label class="form-label"></label>
                    <b-form-select class="form-control" type="text" id="categoriaConsulta" v-model="categoriaConsulta" :options="optionsCategoria"></b-form-select>
                </b-col>
                
            </b-row>

            <b-row class="m-2 justify-content-end">
                <b-col lg="3">
                    <b-button variant="primary" v-if="tipoConsulta != '' && (this.optionsPesquisaCliente != null || this.optionsPesquisaFuncionario != null)">Consultar</b-button>
                </b-col>
            </b-row>
        </div>
    </div>
</template>
