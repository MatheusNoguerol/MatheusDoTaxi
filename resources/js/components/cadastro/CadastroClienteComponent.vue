
<script>
export default {
  data(){
    return{
      codCliente: null,
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
          key: 'cpfCnpj',
          label: 'CPF / CNPJ',
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
      temGnv: false,
      possuiGnv: false,
      gnv: null,
      possuiAlienacao: false,
      temAlienacao: false,
      bancoAlienado: null,
      renavan: null,
      chassi: null,
      anoModelo: null,
      anoFab: null,
      combustivel: null,
      categoria: null,
      ultimoLa: null,
      optionsFormasPix: [
        { value: 'cpf' , text: 'CPF'},
        { value: 'cnpj' , text: 'CNPJ'},
        { value: 'tel' , text: 'Telefone'},
        { value: 'email' , text: 'Email'},
        { value: 'aleatoria' , text: 'Aleatória'},
      ],
      tipoChave: null,
      chave: null,
    }
  },

  computed: {
    rowsClientes() {
      return this.itemsClientes.length
    },

    DadosCriaCliente() {
      return [{
        nome: this.nome,
        cpfCnpj: this.cpfCnpj,
        nascimento: this.nascimento,
        email: this.email,
        telefone: this.telefone,
        tipoCliente: this.tipoCliente,
        cep: this.cep,
        logradouro: this.logradouro,
        numero: this.numero,
        status: this.status,
        complemento: this.complemento,
        uf: this.uf,
        municipio: this.municipio,
        bairro: this.bairro,
        msg: this.msg,
        placa: this.placa,
        renavan: this.renavan,
        chassi: this.chassi,
        anoModelo: this.anoModelo,
        anoFab: this.anoFab,
        combustivel: this.combustivel,
        possuiGnv: this.possuiGnv,
        gnv: this.gnv,
        categoria: this.categoria,
        possuiAlienacao: this.possuiAlienacao,
        bancoAlienado: this.bancoAlienado,
        ultimoLa: this.ultimoLa,
        vencApolice: this.vencApolice,
        atualSeguradora: this.atualSeguradora,
        nmrbanco: this.nmrbanco,
        banco: this.banco,
        agencia: this.agencia,
        conta: this.conta,
        titular: this.titular,
        cpfTitular: this.cpfTitular,
        tipoConta: this.tipoConta,
        tipoChave: this.tipoChave,
        chave: this.chave,
        user: this.user,
        codCliente: this.codCliente = null ? null : this.codCliente
      }]
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
  },

  methods:{
    preLoad(){
      let self = this 

      self.itemsClientes = []

      axios.get('all_clientes')
      .then((response) =>{
        
        for(var i = 0 ; i < response.data.length ; i++){
          self.itemsClientes.push({
            nome: response.data[i]['NOME'],
            cpfCnpj: response.data[i]['CPFCNPJ'],
            codCliente: response.data[i]['CODCLIENTE'],
            nascimento: response.data[i]['CODCLIENTE'],
            email: response.data[i]['EMAIL'],
            telefone: response.data[i]['TELEFONE'],
            tipoCliente: response.data[i]['TIPOCLIENTE'],
            cep: response.data[i]['CEP'],
            logradouro: response.data[i]['LOGRADOURO'],
            numero: response.data[i]['NUMERO'],
            complemento: response.data[i]['COMPLEMENTO'],
            uf: response.data[i]['UF'],
            municipio: response.data[i]['MUNICIPIO'],
            bairro: response.data[i]['BAIRRO'],
            msg: response.data[i]['MSG']
          })
        }

      }).catch((error) =>{
        console.log('Error: ', error)
      })
    },

    salvaCliente(){
      let self = this

      axios.post('salva-cliente',{dados: self.DadosCriaCliente})
      .then((response) => {

        self.preLoad()
        self.makeToastSave()
        self.limpaDados()

      })
      .catch((error) => {
        console.log("Aqui: ", error)
      });
    },

    limpaDados(){
      let self = this
      
      self.codCliente = null
      self.nome= null
      self.email= null
      self.msg= null
      self.placa= null
      self.telefone= null
      self.nascimento= null
      self.vencApolice= null
      self.id = null
      self.cpfCnpj = null
      self.tipoCliente = null
      self.cep = null
      self.logradouro = null
      self.numero = null
      self.complemento = null
      self.temComplemento = false
      self.status = false
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
      self.temGnv = false
      self.gnv = null
      self.temAlienacao = false
      self.possuiGnv = false
      self.possuiAlienacao = false
      self.bancoAlienado = null
      self.renavan = null
      self.chassi = null
      self.anoModelo = null
      self.anoFab = null
      self.combustivel = null
      self.categoria = null
      self.ultimoLa = null
      self.tipoChave = null
      self.chave = null
        

      self.temClienteSelecionado = false
    },

    abreModal(){
      this.modalShow = true
    },

    selecionaCliente(row){
      let self = this

      self.codCliente = row.item.codCliente
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

      if(self.complemento != null){
        self.temComplemento = true
        self.status = 'possui'
      }else{
        self.temComplemento = false
        self.status = 'nao_possui'
      }

      this.$bvModal.hide('info-cliente')

      axios.post('seleciona-cliente', {codigo: row.item.codCliente})
      .then((response) => {

      if(response.data.success === 2){

        self.placa = response.data[0][0]['PLACA']
        self.renavan = response.data[0][0]['RENAVAN']
        self.chassi = response.data[0][0]['CHASSI']
        self.anoModelo = response.data[0][0]['ANOMODELO']
        self.anoFab = response.data[0][0]['ANOFAB']
        self.combustivel = response.data[0][0]['COMBUSTIVEL']
        self.possuiGnv = response.data[0][0]['TEMGAS']
        self.gnv = response.data[0][0]['CILINDRO']
        self.categoria = response.data[0][0]['CATEGORIA']
        self.possuiAlienacao = response.data[0][0]['TEMALIENACAO']
        self.bancoAlienado = response.data[0][0]['BANCOALIENADO']
        self.ultimoLa = response.data[0][0]['ULTIMOLA']
        self.vencApolice = response.data[0][0]['VENCAPOLICE']
        self.atualSeguradora = response.data[0][0]['ATUALSEGURADORA']
        self.makeToastNoInfo()
        
        if(self.gnv != null){
          self.temGnv = true
          self.possuiGnv = '1'
        }else{
          self.temGnv = true
          self.possuiGnv = '0'
        }

        if(self.bancoAlienado != null){
          self.temAlienacao = true
          self.possuiAlienacao = 1
        }else{
          self.temAlienacao = true
          self.possuiAlienacao = 0
        }
      
      }else if(response.data.success === 3){

        self.nmrbanco = response.data[0][0]['NOBANCO']
        self.agencia = response.data[0][0]['AGENCIA']
        self.conta = response.data[0][0]['CONTA']
        self.banco = response.data[0][0]['BANCO']
        self.titular = response.data[0][0]['TITULAR']
        self.cpfTitular = response.data[0][0]['CPFTITULAR']
        self.tipoConta = response.data[0][0]['TIPOCONTA']
        self.tipoChave = response.data[0][0]['TIPOCHAVE']
        self.chave = response.data[0][0]['CHAVE']
        self.makeToastNoInfo()

      }else if(response.data.success === 4){

        self.placa = response.data[0][0]['PLACA']
        self.renavan = response.data[0][0]['RENAVAN']
        self.chassi = response.data[0][0]['CHASSI']
        self.anoModelo = response.data[0][0]['ANOMODELO']
        self.anoFab = response.data[0][0]['ANOFAB']
        self.combustivel = response.data[0][0]['COMBUSTIVEL']
        self.possuiGnv = response.data[0][0]['TEMGAS']
        self.gnv = response.data[0][0]['CILINDRO']
        self.categoria = response.data[0][0]['CATEGORIA']
        self.possuiAlienacao = response.data[0][0]['TEMALIENACAO']
        self.bancoAlienado = response.data[0][0]['BANCOALIENADO']
        self.ultimoLa = response.data[0][0]['ULTIMOLA']
        self.vencApolice = response.data[0][0]['VENCAPOLICE']
        self.atualSeguradora = response.data[0][0]['ATUALSEGURADORA']
        self.nmrbanco = response.data[0][0]['NOBANCO']
        self.agencia = response.data[0][0]['AGENCIA']
        self.conta = response.data[0][0]['CONTA']
        self.banco = response.data[0][0]['BANCO']
        self.titular = response.data[0][0]['TITULAR']
        self.cpfTitular = response.data[0][0]['CPFTITULAR']
        self.tipoConta = response.data[0][0]['TIPOCONTA']
        self.tipoChave = response.data[0][0]['TIPOCHAVE']
        self.chave = response.data[0][0]['CHAVE']

        if(self.gnv != null){
          self.temGnv = true
          self.possuiGnv = 1
        }else{
          self.temGnv = true
          self.possuiGnv = 0
        }

        if(self.bancoAlienado != null){
          self.temAlienacao = true
          self.possuiAlienacao = 1
        }else{
          self.temAlienacao = true
          self.possuiAlienacao = 0
        }

      }else if(response.data.error === 1){

        self.makeToastNoInfo()

      }

      }).catch((error) => {
          console.log('Error: ', error)
      })
      
      self.temClienteSelecionado = true
      
    },

    excluiCliente(){
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

    editaCliente(){
        let self = this

        axios.post('edita-cliente',{dados: self.DadosCriaCliente})
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

    makeToastNoInfo(append = false) {
      let self = this

      this.$bvToast.toast(`Cliente  ${self.nome } está com o cadastro incompleto.`, {
        title: 'ATENÇÃO!',
        autoHideDelay: 2500,
        appendToast: append,
        variant: 'warning',
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

    alteraGnv(){
      let self = this

      if(self.possuiGnv === true){
        self.temGnv = true
      }else{
        self.temGnv = false
      }
    },

    alteraAlienacao(){
      let self = this

      if(self.possuiAlienacao === true){
        self.temAlienacao = true
      }else{
        self.temAlienacao = false
      }
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
                    <label for="id">Código Cliente</label>
                    <b-form-input type="text" v-model="codCliente" disabled></b-form-input>
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
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" v-model="placa" name="placa" class="form-control" id="placa">
                  </b-col>

                  <b-col lg="4">
                    <label for="renavan" class="form-label">Renavan</label>
                    <b-form-input type="text" v-model="renavan" name="renavan" class="form-control" id="renavan"></b-form-input>
                  </b-col> 

                  <b-col lg="5">
                    <label for="chassi" class="form-label">Chassi</label>
                    <b-form-input v-model="chassi" id="chassi"></b-form-input>
                  </b-col>

                </b-row>

                <b-row class="my-2">
                  
                  <b-col lg="3">
                    <label for="ANOMODELO" class="form-label">Ano Modelo</label>
                    <b-form-input type="text" v-model="anoModelo" class="form-control" maxLength="4" id="ANOMODELO" ></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="ANOFAB" class="form-label">Ano Fab.</label>
                    <b-form-input type="text" v-model="anoFab" class="form-control" maxLength="4" id="ANOFAB" ></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="COMBUSTIVEL" class="form-label">Combustível</label>
                    <b-form-input type="text" v-model="combustivel" class="form-control" id="COMBUSTIVEL" ></b-form-input>
                  </b-col>
                  
                  <b-col lg="3">
                    <label for="gnv" id="gnv" class="form-label">GNV</label>
                    <b-input-group append="m³">
                      <b-input-group-prepend is-text>
                        <input type="checkbox" 
                        v-model="possuiGnv"
                        value="1"
                        unchecked-value="0" @change="alteraGnv()">
                      </b-input-group-prepend>
                      <b-form-input type="text" disabled v-if="temGnv == false"></b-form-input>
                      <b-form-input type="text" v-if="temGnv == true" v-model="gnv"></b-form-input>
                    </b-input-group>
                  </b-col>

                </b-row>

                <b-row class="my-2">
                  
                  <b-col lg="3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <b-form-input type="text" v-model="categoria" class="form-control" id="categoria" ></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="alienacao" id="alienacao" class="form-label">Alienação</label>
                    <b-input-group>
                      <b-input-group-prepend is-text>
                        <input type="checkbox" 
                        v-model="possuiAlienacao"
                        value="1"
                        unchecked-value="0" @change="alteraAlienacao()">
                      </b-input-group-prepend>
                      <b-form-input type="text" disabled v-if="temAlienacao == false"></b-form-input>
                      <b-form-input type="text" v-if="temAlienacao == true" v-model="bancoAlienado"></b-form-input>
                    </b-input-group>
                  </b-col> 
                  
                  <b-col lg="3">
                    <label for="ultimoLa">Último L.A</label>
                    <b-form-input type="date" id="ultimoLa" v-model="ultimoLa" max="9999-12-31"></b-form-input>
                  </b-col> 

                </b-row>

                <b-row class="my-2">

                  <b-col lg="3">
                    <label for="vencimentoApolice" class="form-label">Venc. Apolice</label>
                    <b-form-input type="date" v-model="vencApolice" name="vencApolice" class="form-control" id="vencimentoApolice" max="9999-12-31"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="atualSeguradora">Atual seguradora</label>
                    <b-form-input type="text" id="atualSeguradora" v-model="atualSeguradora"></b-form-input>
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

                <b-row class="my-3">
                  
                  <b-col lg="3">
                    <label for="pix">Escolha o tipo da chave</label>
                    <b-form-select type="text" :options="optionsFormasPix" v-model="tipoChave" class="form-control" id="pix"></b-form-select>
                  </b-col>

                  <b-col lg="3" v-if="this.tipoChave != null">
                    <label for="chave">PIX</label>
                    <b-form-input type="text" v-model="chave" class="form-control" id="chave"></b-form-input>
                  </b-col>

                </b-row>
                
              </b-tab>
            </b-tabs>
          </b-card>
        </div>  


        <div class="row">
          <div class="col">
            <div class="mb-3">
              <b-button variant="light" v-if="temClienteSelecionado == false" @click.prevent="salvaCliente()" id="btn-selecao">Cadastrar</b-button>

              <b-button variant="success" v-if="temClienteSelecionado == true" @click.prevent="editaCliente()">Editar</b-button>
              <b-button variant="danger" v-if="temClienteSelecionado == true" @click.prevent="excluiCliente()">Deletar</b-button>
              <div style="font-size: 3.3rem;" v-if="this.nome != null || this.temClienteSelecionado == true">

                <div style="font-size: 3.3rem;" v-if="this.nome != null">
                  <b-button pill variant="primary" @click.prevent="limpaDados()" id="btn-selecao">Limpar</b-button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </form>
      
      <div>
        <b-button variant="light" id="btn-selecao" @click.prevent="abreModal()">Consultar Clientes</b-button>
      </div>

    </div>

    <b-modal v-model="modalShow" id="info-cliente" size="lg" hide-footer>
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
            <a><b-icon cursor="pointer" variant="info" icon="pencil" font-scale="1" data-bs-toggle="tooltip" title="Selecionar cliente" @click.prevent="selecionaCliente(row)"></b-icon></a>
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
