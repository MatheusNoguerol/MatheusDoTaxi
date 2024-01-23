
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
        }
    },

    computed: {
        // rowsClientes() {
        // return this.itemsClientes.length
        // },
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
        margin: 2rem;
        padding: 1rem;
    }

</style>

<template>
  <div>
    
    <h1 class="text-center">Cadastrar segurado</h1>
    
    <div id="form">
        <b-row>
            <fieldset>
                <b-col lg="12" class="m-2">
                    <b-row>
                        <b-col lg="12">
                            <h4><b><i>Informações pessoais</i></b></h4>
                        </b-col>
                    </b-row>

                    <b-row>
                        <b-col lg="2" class="pl-4">
                            <label for="codigoSegurado">Cód. segurado</label>
                            <b-input-group>
                                <b-form-input id="codigoSegurado" disabled v-model="codigoSegurado" class="form-control"></b-form-input>
                                <b-input-group-append>
                                    <b-button class="primary" @click="buscaSegurado()"><b-icon icon="search"></b-icon></b-button>
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

                        <b-col lg="2" class="pl-4">
                            <label for="sexoSegurado">Sexo</label>
                            <b-form-select :options="optionsSexo" v-model="sexoSegurado" id="sexoSegurado"></b-form-select>
                        </b-col>

                        <b-col lg="2" class="pl-4">
                            <label for="telefoneSegurado">Telefone</label>
                            <b-form-input v-model="telefoneSegurado" v-mask="'(##) # ####-####'" id="telefoneSegurado"></b-form-input>
                        </b-col>
                    </b-row>
                </b-col>
            </fieldset>
        </b-row>

        <b-row class="m-2">
            <b-col lg="3">
                <label for="emailSegurado">Email</label>
                <b-form-input v-model="emailSegurado" id="emailSegurado"></b-form-input>
            </b-col>
        </b-row>

        <b-row class="m-2">
            <b-col lg="2">
                <label for="cepSegurado">CEP</label>
                <b-form-input v-model="cepSegurado" id="cepSegurado" v-mask="'#####-###'" @change="buscaCep()"></b-form-input>
            </b-col>

            <b-col lg="4">
                <label for="logradouroSegurado">Endereço</label>
                <b-form-input v-model="logradouroSegurado" id="logradouroSegurado"></b-form-input>
            </b-col>

            <b-col lg="2">
                <label for="numeroSegurado">Número</label>
                <b-form-input type="number" v-model="numeroSegurado" id="numeroSegurado"></b-form-input>
            </b-col>

            <b-col lg="4">
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
        </b-row>

        <b-row class="m-2">
            <b-col lg="2">
                <label for="ufSegurado">UF</label>
                <b-form-input type="text" v-model="ufSegurado" id="ufSegurado"></b-form-input>
            </b-col>

            <b-col lg="5">
                <label for="municipioSegurado">Município</label>
                <b-form-input type="text" v-model="municipioSegurado" id="municipioSegurado"></b-form-input>
            </b-col>

            <b-col lg="4">
                <label for="bairroSegurado">Bairro</label>
                <b-form-input type="text" id="bairroSegurado" v-model="bairroSegurado"></b-form-input>
            </b-col>
        </b-row>
    </div>

    <b-modal id="modal-busca-segurado" size="xl" hide-footer title="Busca segurado">

    </b-modal>
    
  </div>
</template>
