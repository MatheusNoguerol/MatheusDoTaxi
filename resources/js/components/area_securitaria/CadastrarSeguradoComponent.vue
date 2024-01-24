
<script>
export default {
    data(){
        return{
            hoje: null,
            codigoSegurado: null,
            nomeSegurado: null,
            cpfSegurado: null,
            dtNascimentoSegurado: null,
            optionsSexo: [
                {text: 'Masculino', value: 'masculino'},
                {text: 'Feminino', value: 'feminino'},
            ],
            sexoSegurado: null,
            emailSegurado: null,
            telefoneSegurado: null,
            cepSegurado: null,
            logradouroSegurado: null,
            numeroSegurado: null,
            status: 0,
            complementoSegurado: null,
            ufSegurado: null,
            municipioSegurado: null,
            bairroSegurado: null,
            fieldsSegurados: [
                {
                    key: 'CODSEGURADO',
                    label: 'Cód. segurado',
                    sortable: true
                },
                {
                    key: 'NOME',
                    label: 'Nome',
                    sortable: true
                },
                {
                    key: 'NOSSOAFILIADO',
                    label: 'Afiliado',
                    sortable: true
                },
                {
                    key: 'acoes',
                    label: 'Ações',
                    sortable: true
                },
            ],
            itemsSegurado: [],
            isBusySegurados: false,
            currentPageSegurados: 1,
            naoTemSegurado: false,
            temSegurado: false,
            optionsEstadoCivil: [
                {value: 'solteiro', text: 'Solteiro'},
                {value: 'casado', text: 'Casado'},
                {value: 'separado', text: 'Separado'},
                {value: 'divorciado', text: 'Divorciado'},
                {value: 'viuvo', text: 'Viúvo'},
            ], 
            estadoCivil: null,
            buttonCadastrarEnderecoPessoal: false,
            querEnderecoPessoal: false,
        }
    },

    computed: {
        rowsSegurados() {
            return this.itemsSegurados.length
        },
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
        self.dtNascimentoSegurado = formatDate(today)

    },  

    methods:{
        preLoad(){
            let self = this 

            axios.get('all-seguradoras')
            .then((response) => {
                console.log("Response", response)
            }).catch((error) => {
                console.log('Error: ', error)
            })

        },

        buscaSegurado(){
            let self = this

            self.$bvModal.show('modal-busca-segurado')
            axios.post('busca-segurado',{})
        },

        selecionaSegurado(row){
            let self = this

            console.log(row)
        },

        cadastrarEnderecoPessoal(){
            let self = this

            if(self.querEnderecoPessoal == false){
                self.querEnderecoPessoal = true
            }else{
                self.querEnderecoPessoal = false
            }
        }
    }
}
</script>

<style scoped>

    #btn-selecao:hover{
        background-color: blue;
        color: white;
        font-weight: bolder;
        border: none;
    }

    #form{
        border-radius: 2rem;
        background-color: white;
        margin: 1rem;
        padding: 1rem;
    }

</style>

<template>
    <div>
        <h1 class="text-center">Cadastrar segurado</h1>
    
        <div id="form">
            <fieldset style="border-radius: 0.42rem; border: 1px solid RGBA( 169, 169, 169, 0.4)">
                <b-row class="m-2">
                    <b-col lg="12">
                        <b-row>
                            <b-col lg="12">
                                <h4><b><i>Informações pessoais</i></b></h4>
                                <hr class="w-100 secondary pt-0 mt-0">
                            </b-col>
                        </b-row>

                        <b-row>
                            <b-col lg="2" class="pl-4">
                                <label for="codigoSegurado">Cód. segurado</label>
                                <b-input-group>
                                    <b-form-input id="codigoSegurado" disabled v-model="codigoSegurado" class="form-control"></b-form-input>
                                    <b-input-group-append>
                                        <b-button variant="outline-primary" @click="buscaSegurado()"><b-icon icon="search"></b-icon></b-button>
                                    </b-input-group-append>
                                </b-input-group>
                            </b-col>

                            <b-col lg="3" class="pl-4">
                                <label for="nomeSegurado">Nome</label>
                                <b-form-input v-model="nomeSegurado"></b-form-input>
                            </b-col>

                            <b-col lg="2" class="pl-4">
                                <label for="cpfSegurado">CPF</label>
                                <b-form-input v-model="cpfSegurado" id="cpfSegurado" v-mask="'###.###.###-##'"></b-form-input>
                            </b-col>

                            <b-col lg="2" class="pl-4">
                                <label for="dtNascimentoSegurado">Dt. nascimento</label>
                                <b-form-input type="date" max="9999-12-31" id="dtNascimentoSegurado" v-model="dtNascimentoSegurado"></b-form-input>
                            </b-col>

                            <b-col lg="1" class="pl-4">
                                <label for="sexoSegurado">Sexo</label>
                                <b-form-select :options="optionsSexo" v-model="sexoSegurado" id="sexoSegurado"></b-form-select>
                            </b-col>

                            <b-col lg="2" class="pl-4">
                                <label for="estadoCivil">Estado cívil</label>
                                <b-form-select :options="optionsEstadoCivil" v-model="estadoCivil" id="estadoCivil"></b-form-select>
                            </b-col>
                        </b-row>
                    </b-col>
                </b-row>

                <b-row class="m-2">
                    <b-col lg="2" class="pl-4">
                        <label for="telefoneSegurado">Telefone</label>
                        <b-form-input v-model="telefoneSegurado" v-mask="'(##) # ####-####'" id="telefoneSegurado"></b-form-input>
                    </b-col>

                    <b-col lg="3">
                        <label for="emailSegurado">Email</label>
                        <b-form-input v-model="emailSegurado" id="emailSegurado"></b-form-input>
                    </b-col>

                    <b-col lg="3" class="pt-4 mt-1">
                        <b-button variant="primary" @click="cadastrarEnderecoPessoal()">Cadastrar endereço pessoal</b-button>
                    </b-col>
                </b-row>

                <b-row class="m-2" v-if="querEnderecoPessoal == true">
                    <b-col lg="1" class="pl-4">
                        <label for="cepSegurado">CEP</label>
                        <b-form-input v-model="cepSegurado" id="cepSegurado" v-mask="'#####-###'" @change="buscaCep()"></b-form-input>
                    </b-col>

                    <b-col lg="3" class="pl-4">
                        <label for="logradouroSegurado">Endereço</label>
                        <b-form-input v-model="logradouroSegurado" id="logradouroSegurado"></b-form-input>
                    </b-col>

                    <b-col lg="1" class="pl-4">
                        <label for="numeroSegurado">Número</label>
                        <b-form-input type="number" v-model="numeroSegurado" id="numeroSegurado"></b-form-input>
                    </b-col>

                    <b-col lg="2" class="pl-4">
                        <label for="complementoSegurado" id="complementoSegurado" class="form-label">Complemento</label>
                        <b-input-group>
                            <b-input-group-prepend is-text>
                            <input type="checkbox" v-model="status"
                            value="1"
                            unchecked-value="0">
                            </b-input-group-prepend>
                            <b-form-input type="text" disabled v-if="status == 0" v-model="complementoSegurado"></b-form-input>
                            <b-form-input type="text" v-if="status == 1" v-model="complementoSegurado"></b-form-input>
                        </b-input-group>
                    </b-col>

                    <b-col lg="1" class="pl-4">
                        <label for="ufSegurado">UF</label>
                        <b-form-input type="text" v-model="ufSegurado" id="ufSegurado"></b-form-input>
                    </b-col>

                    <b-col lg="2" class="pl-4">
                        <label for="municipioSegurado">Município</label>
                        <b-form-input type="text" v-model="municipioSegurado" id="municipioSegurado"></b-form-input>
                    </b-col>

                    <b-col lg="2" class="pl-4">
                        <label for="bairroSegurado">Bairro</label>
                        <b-form-input type="text" id="bairroSegurado" v-model="bairroSegurado"></b-form-input>
                    </b-col>
                </b-row>
            </fieldset>
        </div>

        <b-modal id="modal-busca-segurado" size="xl" hide-footer title="Busca segurado">
            <b-row>
                <b-col lg="12" class="mt-0 pt-0">
                    <b-table
                    id="table-segurados"
                    :fields="fieldsSegurados"
                    :items="itemsSegurado"
                    :busy="isBusySegurados"
                    :current-page="currentPageSegurados"
                    bordered
                    head-variant="light"
                    per-page="5">
                        <template #table-busy>
                            <div class="text-center text-primary my-2">
                                <b-spinner class="align-middle"></b-spinner>
                                <strong>Carregando...</strong>
                            </div>
                        </template>

                        <template #cell(acoes)="row">
                            <b-button size="sm" class="m-1 p-1" variant="outline-primary" data-bs-toggle="tooltip" title="Selecionar segurado" @click="selecionaSegurado(row)">
                                <b-icon icon="plus"></b-icon>
                            </b-button>
                        </template>
                    </b-table>
                </b-col>
            </b-row>
            
            <b-row v-if="this.naoTemSegurado == true">
                <b-col lg="12" class="mt-0 pt-0">
                    <h4 class="text-white bg-danger p-5 rounded w-75">Nenhum registro foi encontrado.</h4>
                </b-col>
            </b-row>

            <b-row v-if="this.temSegurado == true">
                <b-col lg="12" class="mt-0 pt-0">
                    <div class="justify-content-end d-flex mt-0 pt-0">
                        <small class="text-muted mt-0 pt-0"><p>{{rowsSegurados}} registros encontrados.</p></small>
                    </div>
                </b-col>
            </b-row>

            <b-row v-if="this.temSegurado == true">
                <b-col lg="12" class="mt-0 pt-0">
                    <div class="justify-content-center d-flex">
                        <b-pagination
                            v-model="currentPageSegurados"
                            :total-rows="rowsSegurados"
                            per-page="5"
                            aria-controls="table-segurados">
                        </b-pagination>
                    </div>
                </b-col>
            </b-row>
        </b-modal>
    </div>
</template>
