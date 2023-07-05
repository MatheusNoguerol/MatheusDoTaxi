
<script>
  export default {
    data(){
      return{
        id: null,
        nome: null,
        email: null,
        msg: null,
        placa: null,
        telefone: null,
        nascimento: null,
        vencApolice: null,
        temNome : false,
        temItemSelecionado : false,
        cliente : '',
        fieldsClientes: [
          {
            key: 'nome',
            label: 'Nome',
            sortable: true
          },
          {
            key: 'placa',
            label: 'Placa',
            sortable: true
          },
          {
            key: 'acoes',
            label: 'Ações',
            sortable: true
          },
        ],
        itemsClientes: [],
        modalShow: false,
        showInfo: false,
        temClienteSelecionado: false,
        optionsClientes: [
        { value: 'pf', text: 'Pessoa física' },
        { value: 'pj', text: 'Pessoa jurídica'}
        ],
        cpfCnpj: null,
        tipoCliente: null,
        cep: null,
        logradouro: null,
        numero: null,
        complemento: null,
        uf: null,
        municipio: null,
        bairro: null,
        atualSeguradora: null,
        comissao: null,
        id: null,
        nmrbanco: null,
        agencia: null,
        conta: null,
        banco: null,
        titular: null,
        cpfTitular: null,
        tipoConta: null,
        OptionsConta: [
        { value: 'cc', text: 'Conta Corrente' },
        { value: 'cp', text: 'Conta Poupança'}
        ],
        status: false,
        temComplemento: false,
        idDC: null,
        nomeDC: null,
        cpfCnpjDC: null,
        perPageClientes: 10,
        currentPageClientes: 1,
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
  
      this.allClientes()
      
    },

    methods:{
    salvaCliente(){
      let self = this

      axios.post('save_cliente',{
        nome : this.nome,
        email : this.email,
        msg : this.msg,
        placa: this.placa,
        telefone: this.telefone,
        nascimento: this.nascimento,
        vencApolice: this.vencApolice,
        cpfCnpj: this.cpfCnpj,
        tipoCliente: this.tipoCliente,
        cep: this.cep,
        logradouro: this.logradouro,
        numero: this.numero,
        complemento: this.complemento,
        uf: this.uf,
        municipio: this.municipio,
        bairro: this.bairro,
        atualSeguradora: this.atualSeguradora,
        comissao: this.comissao,
        nmrbanco: this.nmrbanco,
        agencia: this.agencia,
        conta: this.conta,
        banco: this.banco,
        titular: this.titular,
        cpfTitular: this.cpfTitular,
        tipoConta: this.tipoConta,
        responsavel: self.user
      })
      .then((response) => {
        self.allClientes()
        self.makeToastSave()
        self.limpaDados()
      })
      .catch((error) => {
        console.log("Aqui: ", error)
      });
    },

    allClientes(){
      let self = this

      self.itemsClientes = []
      axios.get('all_clientes')
      .then((response) =>{
        for(var i = 0 ; i < response.data.length ; i++){
          self.itemsClientes.push(response.data[i])
        }
        this.itemsClientes = response.data


      }).catch((error) =>{
        console.log('Error: ', error)
      })
    },

    limpaDados(){
      let self = this

      this.nome= null
      this.email= null
      this.msg= null
      this.placa= null
      this.telefone= null
      this.nascimento= null
      this.vencApolice= null
      self.id = null
      self.cpfCnpj = null
      self.tipoCliente = null
      self.cep = null
      self.logradouro = null
      self.numero = null
      self.complemento = null
      self.uf = null
      self.municipio = null
      self.bairro = null
      self.atualSeguradora = null
      self.comissao = null
      self.id = null
      self.comissao = null
      self.tipoCliente = null
      self.nmrbanco = null
      self.agencia = null
      self.conta = null
      self.banco = null
      self.titular = null
      self.cpfTitular = null
      self.tipoConta = null

      self.temClienteSelecionado = false
    },

    abreModal(){
      this.modalShow = true
    },

    SelecionaCliente(row){
      let self = this
      
      
      self.id = row.item.id
      self.nome = row.item.nome
      self.email = row.item.email
      self.placa = row.item.placa
      self.telefone = row.item.telefone
      self.nascimento = row.item.nascimento
      self.vencApolice = row.item.vencApolice
      self.msg = row.item.msg
      self.cpfCnpj = row.item.cpfCnpj
      self.tipoCliente = row.item.tipoCliente
      self.cep = row.item.cep
      self.logradouro = row.item.logradouro
      self.numero = row.item.numero
      self.complemento = row.item.complemento
      self.uf = row.item.uf
      self.municipio = row.item.municipio
      self.bairro = row.item.bairro
      self.atualSeguradora = row.item.atualSeguradora
      self.id = row.item.id
      self.comissao = row.item.comissao
      

      axios.post('info-fin-cli', {id: self.id})
      .then((response) => {
        console.log("Aqui:", response)

        self.nmrbanco = response.data[0].nobanco
        self.agencia = response.data[0].agencia
        self.conta = response.data[0].conta
        self.banco = response.data[0].banco
        self.titular = response.data[0].titular
        self.cpfTitular = response.data[0].cpfTitular
        self.tipoConta = response.data[0].tipo

      }).catch((error) => {
        console.log("Error: ", error)
      })

      self.temClienteSelecionado = true
      
      this.$bvModal.hide('info-cliente')

      if(row.item.complemento.length > 0 ){
        self.temComplemento = true
      }else{
        self.temComplemento = false
      }
    },

    ExcluiCliente(){
        let self = this

        axios.post('exclui-cliente',{id: self.id, nome : this.nome})
        .then((response) => {
          self.allClientes()
          self.makeToastExclui()
          self.limpaDados()
        }).catch((error) => {
          console.log("Error: ", error)
        })
    },

    EditaCliente(){
        let self = this

        axios.post('edita-cliente',{
          id: self.id,
          nome : self.nome,
          email : self.email,
          msg : self.msg,
          placa: self.placa,
          telefone: self.telefone,
          nascimento: self.nascimento,
          vencApolice: self.vencApolice,
          cpfCnpj: self.cpfCnpj,
          tipoCliente: self.tipoCliente,
          cep: self.cep,
          logradouro: self.logradouro,
          numero: self.numero,
          complemento: self.complemento,
          uf: self.uf,
          municipio: self.municipio,
          bairro: self.bairro,
          atualSeguradora: self.atualSeguradora,
          id: self.id,
          comissao: self.comissao,
          nmrbanco: self.nmrbanco,
          agencia: self.agencia,
          conta: self.conta,
          banco: self.banco,
          titular: self.titular,
          cpfTitular: self.cpfTitular,
          tipoConta: self.tipoConta
          })
        .then((response) => {
          self.allClientes()
          self.makeToast()
          self.limpaDados()
        }).catch((error) => {
          console.log("Error: ", error)
      })
    },

    makeToast(append = false) {
      let self = this

      this.$bvToast.toast(`Cliente com id ${self.id }  editado.`, {
        title: 'SUCESSO!',
        autoHideDelay: 2500,
        appendToast: append,
        variant: 'success',
      })

    },

    makeToastSave(append = false) {
      let self = this

      this.$bvToast.toast(`Cliente  ${self.nome }  criado.`, {
        title: 'SUCESSO!',
        autoHideDelay: 2500,
        appendToast: append,
        variant: 'success',
      })

    },
    
    makeToastExclui(append = false) {
    let self = this

    this.$bvToast.toast(`Cliente  ${self.id }  deletado.`, {
      title: 'SUCESSO!',
      autoHideDelay: 2500,
      appendToast: append,
      variant: 'success',
    })

    },

    buscaCep(){
      let self = this 

      axios.get('https://viacep.com.br/ws/'+self.cep+'/json/')
      .then((response) => {

        self.logradouro = response.data.logradouro
        self.uf = response.data.uf
        self.municipio = response.data.localidade
        self.bairro = response.data.bairro
        document.getElementById('numero').focus();

      }).catch((error) => {
        console.log("Error: ", error)
      })
    },
    
    possuiComplemento(){
      let self = this

      if(self.status === true){
        self.temComplemento = true
      }else{
        self.temComplemento = false
      }
    },
  },   
}
</script>

<template>
  <div>
    Olá
    <h1 v-if="temClienteSelecionado == false" class="text-center">Cadastrar Cliente</h1>
    <h1 v-if="temClienteSelecionado == true" class="text-center">Editar Cliente</h1>
    
    <div class="container text-center mt-3" id="formulário-de-cadastro">
      <form method="POST">
        <div class="container">
          <b-card>
            <b-tabs content-class="mt-3" no-body>
              <b-tab title="Dados Pessoais" active no-body>
                <b-row class="my-2">
                  
                  <b-col lg="2">
                    <label for="id">ID</label>
                    <b-form-input type="text" v-model="id" disabled></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="nome" class="form-label">Nome</label>
                    <input v-model="nome" type="text" name="nome" class="form-control" id="nome">
                  </b-col>

                  <b-col lg="3">
                    <label for="cpfCnpj">CPF / CNPJ</label>
                    <b-form-input v-model="cpfCnpj" name="cpfCnpj" id="cpfCnpj"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="nascimento">Dt. nascimento</label>
                    <b-form-input type="date" id="nascimento" v-model="nascimento" name="nascimento" max="9999-12-31"></b-form-input>
                  </b-col>

                </b-row>

                <b-row class="my-2">

                  <b-col lg="4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" v-model="email" name="email" class="form-control" id="email">
                  </b-col>

                  <b-col lg="4">
                    <label for="telefone" class="form-label">telefone</label>
                    <input type="text" v-model="telefone" name="telefone" class="form-control" id="telefone">
                  </b-col>

                  <b-col lg="3">
                    <label for="tipoCliente">Tipo</label>
                    <b-form-select :options="optionsClientes" v-model="tipoCliente" id="tipoCliente"></b-form-select>
                  </b-col>

                </b-row>

                <b-row class="my-2">

                  <b-col lg="2">
                    <label for="cep">CEP</label>
                    <b-form-input v-model="cep" id="cep" @change="buscaCep()"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="logradouro">Endereço</label>
                    <b-form-input v-model="logradouro" id="logradouro"></b-form-input>
                  </b-col>

                  <b-col lg="2">
                    <label for="numero">Número</label>
                    <b-form-input type="number" v-model="numero" id="numero"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="complemento" id="complemento" class="form-label">Complemento</label>
                    <b-input-group>
                      <b-input-group-prepend is-text>
                        <input type="checkbox" v-model="status"
                        value="possui"
                        unchecked-value="nao_possui" @change="possuiComplemento()">
                      </b-input-group-prepend>
                      <b-form-input type="text" disabled v-if="temComplemento == false" v-model="complemento"></b-form-input>
                      <b-form-input type="text" v-if="temComplemento == true" v-model="complemento"></b-form-input>
                    </b-input-group>
                  </b-col>

                </b-row>

                <b-row class="my-2">

                  <b-col lg="2">
                    <label for="uf">UF</label>
                    <b-form-input type="text" v-model="uf" id="uf"></b-form-input>
                  </b-col>

                  <b-col lg="5">
                    <label for="municipio">Município</label>
                    <b-form-input type="text" v-model="municipio" id="municipio"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="bairro">Bairro</label>
                    <b-form-input type="text" id="bairro" v-model="bairro"></b-form-input>
                  </b-col>

                </b-row>

                <b-row class="my-2">

                  <b-col lg="12">
                    <label for="msg" class="form-label">Mensagem</label>
                    <br><textarea name="msg" v-model="msg" id="msg" rows="5" class="w-100" style="border-radius: 1.0rem;"></textarea>
                  </b-col>
                  
                </b-row>
              </b-tab>


              <b-tab title="Veículo" no-body>
                <b-row class="my-2">

                  <b-col lg="3">
                    <label for="vencimentoApolice" class="form-label">Venc. Apolice</label>
                    <b-form-input type="date" v-model="vencApolice" name="vencApolice" class="form-control" id="vencimentoApolice" max="9999-12-31"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="atualSeguradora">Atual seguradora</label>
                    <b-form-input type="text" id="atualSeguradora" v-model="atualSeguradora"></b-form-input>
                  </b-col>                  

                  <b-col lg="3">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" v-model="placa" name="placa" class="form-control" id="placa">
                  </b-col>

                  <b-col lg="3">
                    <label for="comissao" class="form-label">Comissão</label>
                    <b-input-group append="%">
                      <b-form-input v-model="comissao" id="comissao"></b-form-input>
                    </b-input-group>
                  </b-col>

                </b-row>
              </b-tab>


              <b-tab title="Informações financeiras" no-body>
                 <b-row class="my-2">

                  <b-col lg="3">
                    <label for="nmrBanco" class="form-label">N° Banco</label>
                    <b-form-input type="text" v-model="nmrbanco" name="nmrBanco" class="form-control" id="nmrBanco"></b-form-input>
                  </b-col>

                    <b-col lg="3">
                    <label for="banco" class="form-label">Banco</label>
                    <b-form-input v-model="banco" id="banco"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="agencia">Agencia</label>
                    <b-form-input type="text" id="agencia" v-model="agencia"></b-form-input>
                  </b-col>                  

                  <b-col lg="3">
                    <label for="conta" class="form-label">Conta</label>
                    <b-form-input type="text" v-model="conta" name="conta" class="form-control" id="conta"></b-form-input>
                  </b-col>

                </b-row>

                <b-row class="my-2">

                  <b-col lg="5">
                    <label for="titular" class="form-label">Titular</label>
                    <b-form-input type="text" v-model="titular" name="titular" class="form-control" id="titular"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="cpfTitular" class="form-label">CPF Titular</label>
                    <b-form-input type="text" v-model="cpfTitular" name="cpfTitular" class="form-control" id="cpfTitular"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="tipoConta" class="form-label">Tipo conta</label>
                    <b-form-select type="text" v-model="tipoConta" name="tipoConta" :options="OptionsConta" class="form-control" id="tipoConta"></b-form-select>
                  </b-col>
                </b-row>
              </b-tab>


            </b-tabs>
          </b-card>
        </div>


        <div class="row">
          <div class="col">
            <div class="mb-3">
              <b-button variant="light" v-if="temClienteSelecionado == false" @click.prevent="salvaCliente()">Cadastrar</b-button>
              <b-button variant="primary" v-if="temClienteSelecionado == true" @click.prevent="EditaCliente()">Editar</b-button>
              <b-button variant="danger" v-if="temClienteSelecionado == true" @click.prevent="ExcluiCliente()">Deletar</b-button>
              <div style="font-size: 3.3rem;" v-if="this.nome != null">
                <b-button pill variant="primary" @click.prevent="limpaDados()">Limpar</b-button>
              </div>
            </div>
          </div>
        </div>
      </form>
      
      <div>
        <b-button variant="outline-primary" @click.prevent="abreModal()">Consultar Clientes</b-button>
      </div>

    </div>

    <b-modal v-model="modalShow" id="info-cliente" size="md" hide-footer>
      <h1 class="text-center mb-3">Consulta de Clientes</h1>
      <div class="container">

        <b-table
        id="lista-clientes" 
        striped hover 
        :items="itemsClientes" 
        :fields="fieldsClientes" 
        houver  
        outlined 
        responsive
        :per-page="perPageClientes"
        :current-page="currentPageClientes">

          <template #cell(acoes) ="row">
            <a><b-icon cursor="pointer" variant="info" icon="pencil" font-scale="1" data-bs-toggle="tooltip" title="Selecionar cliente" @click.prevent="SelecionaCliente(row)"></b-icon></a>
          </template>

        </b-table>
        
        <b-pagination
          align="center"
          v-model="currentPageClientes"
          :total-rows="rowsClientes"
          :per-page="perPageClientes"
          aria-controls="lista-clientes"
        >
        </b-pagination>

      </div>
    </b-modal>

  </div>
</template>