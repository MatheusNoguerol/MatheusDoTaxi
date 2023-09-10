<script>
  export default {
    data(){
      return{
        temFuncionarioSelecionado: false,
        codFuncionario: null,
        nome: null,
        cpf: null,
        nascimento: null,
        email: null,
        telefone: null,
        cep: null,
        logradouro: null,
        numero: null,
        complemento: null,
        uf: null,
        municipio: null,
        bairro: null,
        obs: null,
        parentescoContatoAdicional1: null,
        nomeContatoAdicional1: null,
        telefoneContatoAdicional1: null,
        optionsParentesco: [
          { value: 'conjuge', text: 'Cônjuge' },
          { value: 'irmao', text: 'Irmão'},
          { value: 'outro', text: 'Outro'}
        ],
        parentescoContatoAdicional2: null,
        nomeContatoAdicional2: null,
        telefoneContatoAdicional2: null,
        temContatoAdicional: false,
        contatoAdicional: null,
        dtAdmissao: null,
        cargo: null,
        comissaoFixa: null,
        ctps: null,
        pispasep : null,
        passagem: null,
        nmrbanco: null,
        banco: null,
        agencia: null,
        conta: null,
        titular: null,
        cpfTitular: null,
        tipoConta: null,
        optionsTipoConta: [
          { value: 'cc', text: 'Conta Corrente' },
          { value: 'cp', text: 'Conta Poupança' },
        ],
        tipoContrato: null,
        optionsContrato: [
          { value: 'mei', text: 'MEI'},
          { value: 'clt', text: 'CLT' }
        ],
        formasPix: null,
        optionsFormasPix: [
          { value: 'cpf' , text: 'CPF'},
          { value: 'cnpj' , text: 'CNPJ'},
          { value: 'tel' , text: 'Telefone'},
          { value: 'email' , text: 'Email'},
          { value: 'aleatoria' , text: 'Aleatória'},
        ],
        chave: null, 
        optionsSexo: [
          { value: 'feminino', text: 'Feminino' },
          { value: 'masculino', text: 'Masculino' }
        ],
        sexo: null,
        itemsFuncionarios: [],
        fieldsFuncionarios: [
          {
            key: 'NOME',
            label: 'Nome',
            sortable: true
          },
          {
            key: 'CPF',
            label: 'CPF',
            sortable: true
          },
          {
            key: 'acoes',
            label: 'Ações',
            sortable: true
          }
        ],
        perPageFuncionarios: 10,
        currentPageFuncionarios: 1,
        id: null,
        documentoEscolhido: null,
        arrayFotos: [],
        file1: null,
        imagen: null,
        teste: '../storage/app/public/images/53mqdefault.jpg',
        tipoDoc: null,
        isBusyTableAnexos: false, 
        fieldsAnexos: [
          {
            key: 'TIPODOCUMENTO',
            label: 'Tipo',
            sortable: true
          },
          {
            key: 'CAMINHO',
            label: 'Arquivo',
            sortable: true
          },
          {
            key: 'acoes',
            label: 'Ações',
            sortable: true
          }
        ],
        currentPageAnexos: null,
        tipoDocumentoEscolhido: null,
        tipoDocumentoPdf: false,
        extensao: null,
        optionsTipoDocumentoAnexo: [
          { value: 'CNH' , text: 'CNH'},
          { value: 'Residência' , text: 'Residência'},
          { value: 'Identidade' , text: 'Identidade'},
          { value: 'CPF' , text: 'CPF'},
          { value: 'CTPS' , text: 'CTPS'},
        ],
        selected: null,
        arquivo: null,
        hoje: null,
        hojeNoFormat: null
      } 
    },

    props: {
      user: {
        type: String,
        default: '',
        required: true
      }
    },

    computed: {
      rowsFuncionarios() {
        return this.itemsFuncionarios.length
      },

      rowsAnexos() {
        return this.arrayFotos.length
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
      self.nascimento = self.hojeNoFormat

      console.log('data: ', self.hoje)
      console.log('data2: ', self.hojeNoFormat)
    },

    methods: {
      preLoad(){
        let self = this 

        self.itemsFuncionarios = []

        axios.get('all-funcionarios')
        .then((response) => {
          
          for (let x = 0; x < response.data.length; x++) {

            self.itemsFuncionarios.push(response.data[x])

          }

        }).catch((error) => {
          console.log("Error: ", error)
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

      salvaFuncionario(){
        let self = this
        
        if(self.nome == null || self.nome == ''){
          self.makeToastNoSaveFuncionario()
        }else{
          axios.post('salva-funcionario', {
            id: self.codFuncionario,
            nome: self.nome,
            cpf: self.cpf,
            nascimento: self.nascimento,
            email: self.email,
            telefone: self.telefone,
            sexo: self.sexo,
            cep: self.cep,
            logradouro: self.logradouro,
            numero: self.numero,
            complemento: self.complemento,
            uf: self.uf,
            municipio: self.municipio,
            bairro: self.bairro,
            temContatoAdicional: self.temContatoAdicional,
            parentescoContatoAdicional1: self.parentescoContatoAdicional1,
            nomeContatoAdicional1: self.nomeContatoAdicional1,
            telefoneContatoAdicional1: self.telefoneContatoAdicional1,
            parentescoContatoAdicional2: self.parentescoContatoAdicional2,
            nomeContatoAdicional2: self.nomeContatoAdicional2,
            telefoneContatoAdicional2: self.telefoneContatoAdicional2,
            obs: self.obs,
            dtAdmissao: self.dtAdmissao,
            cargo: self.cargo,
            tipoContrato: self.tipoContrato,
            comissaoFixa: self.comissaoFixa,
            ctps: self.ctps,
            pispasep: self.pispasep,
            passagem: self.passagem,
            nmrbanco: self.nmrbanco,
            banco: self.banco,
            agencia: self.agencia,
            conta: self.conta,
            titular: self.titular,
            cpfTitular: self.cpfTitular,
            tipoConta: self.tipoConta,
            chave: self.chave,
            formasPix: self.formasPix,
            responsavel: self.user
          }).then((response) => {
            
            self.preLoad()
            self.makeToastSalvaFuncionario()
            self.limpaDados()
                
          }).catch((error) => {
            console.log("Error: ", error)
          })
        }
      },

      selecionaFuncionarios(row){
        let self = this 

        self.codFuncionario = row.item.ID
        self.nome = row.item.NOME
        self.cpf = row.item.CPF
        self.nascimento = row.item.DTNASCIMENTO
        self.email = row.item.EMAIL
        self.telefone = row.item.TELEFONE
        self.sexo = row.item.SEXO
        self.cep = row.item.CEP
        self.logradouro = row.item.LOGRADOURO
        self.numero = row.item.NUMERO
        self.complemento = row.item.COMPLEMENTO
        self.uf = row.item.UF
        self.municipio = row.item.MUNICIPIO
        self.bairro = row.item.BAIRRO
        self.parentescoContatoAdicional1 = row.item.GRAUPARENTESCO1
        self.nomeContatoAdicional1 = row.item.NOME1
        self.telefoneContatoAdicional1 = row.item.TELEFONE1
        self.contatoAdicional = row.item.TEMCONTATOADC
        self.parentescoContatoAdicional2 = row.item.GRAUPARENTESCO2
        self.nomeContatoAdicional2 = row.item.NOME2
        self.telefoneContatoAdicional2 = row.item.TELEFONE2
        self.obs = row.item.OBS

        if(row.item.NOME2 != null){
          self.temContatoAdicional = true
          self.contatoAdicional = 1
        }else{
          self.temContatoAdicional = false
          self.contatoAdicional = 0
        }
        this.$bvModal.hide('info-Funcionarios')

        axios.post('seleciona-dados-extras-funcionarios',{codigo: row.item.ID})
        .then((response) => {

          
          if(response.data.success === 2){

            self.dtAdmissao = response.data[0][0]['DTADMISSAO']
            self.cargo = response.data[0][0]['CARGO']
            self.tipoContrato = response.data[0][0]['TIPOCONTRATO']
            self.comissaoFixa = response.data[0][0]['COMISSAOFIXA']
            self.ctps = response.data[0][0]['CTPS']
            self.pispasep = response.data[0][0]['PISPASEP']
            self.passagem = response.data[0][0]['PASSAGEM']
            
            self.makeToastNoInfo()
        
          }else if(response.data.success === 3){

            self.nmrbanco = response.data[0][0]['NOBANCO']
            self.agencia = response.data[0][0]['AGENCIA']
            self.conta = response.data[0][0]['CONTA']
            self.banco = response.data[0][0]['BANCO']
            self.titular = response.data[0][0]['TITULAR']
            self.cpfTitular = response.data[0][0]['CPFTITULAR']
            self.tipoConta = response.data[0][0]['TIPOCONTA']
            self.formasPix = response.data[0][0]['TIPOCHAVE']
            self.chave = response.data[0][0]['CHAVEPIX']

            self.makeToastNoInfo()

          }else if(response.data.success === 4){

            self.dtAdmissao = response.data[0][0]['DTADMISSAO']
            self.cargo = response.data[0][0]['CARGO']
            self.tipoContrato = response.data[0][0]['TIPOCONTRATO']
            self.comissaoFixa = response.data[0][0]['COMISSAOFIXA']
            self.ctps = response.data[0][0]['CTPS']
            self.pispasep = response.data[0][0]['PISPASEP']
            self.passagem = response.data[0][0]['PASSAGEM']
            self.nmrbanco = response.data[0][0]['NOBANCO']
            self.agencia = response.data[0][0]['AGENCIA']
            self.conta = response.data[0][0]['CONTA']
            self.banco = response.data[0][0]['BANCO']
            self.titular = response.data[0][0]['TITULAR']
            self.cpfTitular = response.data[0][0]['CPFTITULAR']
            self.tipoConta = response.data[0][0]['TIPOCONTA']
            self.formasPix = response.data[0][0]['TIPOCHAVE']
            self.chave = response.data[0][0]['CHAVEPIX']

          }else if(response.data.error === 1){

            self.makeToastNoInfo()

          }
          self.temFuncionarioSelecionado = true
        }).catch((error) => {
            console.log('Error: ', error)
        })

        axios.post('seleciona-anexos', {codFuncionario: self.codFuncionario})
        .then((response) => {
          for (let x = 0; x < response.data.length; x++) {

            self.arrayFotos.push({
              CODFUNCIONARIO: response.data[x].CODFUNCIONARIO,
              TIPODOCUMENTO: response.data[x].TIPODOCUMENTO,
              CAMINHO: response.data[x].CAMINHO,
              EXTENSAO: response.data[x].EXTENSAO
            })

          }
        }).catch((error)=>{
          console.log('Error: ', error)
        })

      },

      editaFuncionario(){
        let self = this

        axios.post('edita-funcionario', {
          id: self.codFuncionario,
          nome: self.nome,
          cpf: self.cpf,
          nascimento: self.nascimento,
          email: self.email,
          telefone: self.telefone,
          sexo: self.sexo,
          cep: self.cep,
          logradouro: self.logradouro,
          numero: self.numero,
          complemento: self.complemento,
          uf: self.uf,
          municipio: self.municipio,
          bairro: self.bairro,
          parentescoContatoAdicional1: self.parentescoContatoAdicional1,
          nomeContatoAdicional1: self.nomeContatoAdicional1,
          telefoneContatoAdicional1: self.telefoneContatoAdicional1,
          parentescoContatoAdicional2: self.parentescoContatoAdicional2,
          nomeContatoAdicional2: self.nomeContatoAdicional2,
          telefoneContatoAdicional2: self.telefoneContatoAdicional2,
          obs: self.obs,
          dtAdmissao: self.dtAdmissao,
          cargo: self.cargo,
          tipoContrato: self.tipoContrato,
          comissaoFixa: self.comissaoFixa,
          ctps: self.ctps,
          pispasep: self.pispasep,
          passagem: self.passagem,
          nmrbanco: self.nmrbanco,
          banco: self.banco,
          agencia: self.agencia,
          conta: self.conta,
          titular: self.titular,
          cpfTitular: self.cpfTitular,
          tipoConta: self.tipoConta,
          chave: self.chave,
          formasPix: self.formasPix
        }).then((response) => {
          self.preLoad()
          self.makeToastEditaFuncionario()
          self.limpaDados()
        }).catch((error) => {
          console.log("Error: ", error)
        })
      },

      excluiFuncionario(){
        let self = this

        axios.post('deleta-funcionario', { id: self.codFuncionario})
        .then((response) => {
          
          self.preLoad()
          self.makeToastExcluiFuncionario()
          self.limpaDados()
          
        }).catch((error) => {
          console.log('Error :' , error)
        })
      },

      limpaDados(){
        let self = this
        
        self.codFuncionario = null
        self.nome = null
        self.cpf = null
        self.nascimento = null
        self.email = null
        self.telefone = null
        self.sexo = null
        self.cep = null
        self.logradouro = null
        self.numero = null
        self.complemento = null
        self.uf = null
        self.municipio = null
        self.bairro = null
        self.parentescoContatoAdicional1 = null
        self.nomeContatoAdicional1 = null
        self.telefoneContatoAdicional1 = null
        self.parentescoContatoAdicional2 = null
        self.nomeContatoAdicional2 = null
        self.telefoneContatoAdicional2 = null
        self.obs = null
        self.dtAdmissao = null
        self.cargo = null
        self.tipoContrato = null
        self.comissaoFixa = null
        self.ctps = null
        self.pispasep = null
        self.passagem = null
        self.nmrbanco = null
        self.banco = null
        self.agencia = null
        self.conta = null
        self.titular = null
        self.cpfTitular = null
        self.tipoConta = null
        self.chave = null
        self.formasPix = null
        self.tipoDoc = null
        self.file1 = null
        self.arrayFotos = []
        self.isBusyTableAnexos = false

        self.temFuncionarioSelecionado = false
        self.contatoAdicional = null
        self.temContatoAdicional = false   

      },

      makeToastEditaFuncionario(append = false) {
        let self = this

        this.$bvToast.toast(`Funcionário  ${self.nome }  editado.`, {
          title: 'SUCESSO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'success',
        })
      },

      makeToastSalvaFuncionario(append = false) {
        let self = this

        this.$bvToast.toast(`Funcionário  ${self.nome }  registrado.`, {
          title: 'SUCESSO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'success',
        })

      },

      makeToastNoSaveFuncionario(append = false){
        let self = this

        this.$bvToast.toast(`Digite pelo menos o nome do funcionário.`, {
          title: 'ATENÇÃO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'warning',
        })
      },

      makeToastExcluiFuncionario(append = false) {
        let self = this

        this.$bvToast.toast(`Funcionário  ${self.nome }  excluído.`, {
          title: 'SUCESSO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'success',
        })
      },

      makeToastNoInfo(append = false) {
        let self = this

        this.$bvToast.toast(`Funcionário ${self.nome } está com o cadastro incompleto.`, {
          title: 'ATENÇÃO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'warning',
        })
      },

      uploadProfileImage(){
        let self = this

        if(self.temFuncionarioSelecionado == false){
          self.makeToastNoFuncionarioSelecionado()
        }else{
          
          if(self.tipoDoc == null || self.tipoDoc == ''){
            self.makeToastNoFile()
          }else{
            self.arrayFotos = []
  
            self.isBusyTableAnexos = true
            const formData = new FormData();
            formData.append("file", self.file1);
            formData.append("cod", self.codFuncionario);
            formData.append("tipoDoc", self.tipoDoc);
  
            axios.post("storage/upload", formData,{
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }).then((response) => {
              
              self.makeToastUpload()
              self.rechargeAnexos()
  
              self.file1 = null
              self.tipoDoc = null
            }).catch((error) => {
              console.log('Error: ', error)
            });
          }
        }
      },

      selecionaAnexo(row){
        let self = this

        self.documentoEscolhido = null
        self.tipoDocumentoEscolhido = null
        self.extensao = null
        self.arquivo = null

        console.log('row ->',row)
        self.documentoEscolhido = '../storage/app/public/images/' + row.item.CAMINHO
        self.arquivo = row.item.CAMINHO
        self.tipoDocumentoEscolhido = row.item.TIPODOCUMENTO
        self.extensao = row.item.EXTENSAO

        if(self.extensao == 'pdf'){
          self.tipoDocumentoPdf = true
        }else{
          self.tipoDocumentoPdf = false
        }      
      },
      
      limpaTipoDocumento(){
        let self = this

        self.tipoDoc = null
      },

      makeToastUpload(append = false) {
         let self = this

          this.$bvToast.toast(`Documento adicionado.`, {
          title: 'SUCESSO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'success',
        })
      },

      makeToastNoFile(append = false) {
        let self = this

        this.$bvToast.toast(`selecione o tipo de documento a ser anexado...`, {
          title: 'ATENÇÃO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'warning',
        })
      },

      deletaAnexo(row){
        let self = this

        self.isBusyTableAnexos = true

        self.arrayFotos = []

        axios.post('deleta-anexo', {codFuncionario: self.codFuncionario, tipoDocumento: row.item.TIPODOCUMENTO, caminho: row.item.CAMINHO})
        .then((response) => {
          console.log(Response)
          axios.post('seleciona-anexos', {codFuncionario: self.codFuncionario})
          .then((response) => {
            for (let x = 0; x < response.data.length; x++) {

              self.arrayFotos.push({
                CODFUNCIONARIO: response.data[x].CODFUNCIONARIO,
                TIPODOCUMENTO: response.data[x].TIPODOCUMENTO,
                CAMINHO: response.data[x].CAMINHO,
                EXTENSAO: response.data[x].EXTENSAO
              })

            }
            self.isBusyTableAnexos = false
          }).catch((error)=>{
            console.log('Error: ', error)
          })
        }).catch((error) => {
          console.log('Error: ', error)
        })
      },

      rechargeAnexos(){
        let self = this

        axios.post('seleciona-anexos', {codFuncionario: self.codFuncionario})
        .then((response) => {
          for (let x = 0; x < response.data.length; x++) {

            self.arrayFotos.push({
              CODFUNCIONARIO: response.data[x].CODFUNCIONARIO,
              TIPODOCUMENTO: response.data[x].TIPODOCUMENTO,
              CAMINHO: response.data[x].CAMINHO,
              EXTENSAO: response.data[x].EXTENSAO
            })

          }
          self.isBusyTableAnexos = false
        }).catch((error)=>{
          console.log('Error: ', error)
        })
      },

      makeToastNoFuncionarioSelecionado(append = false){
        let self = this

        this.$bvToast.toast(`Para anexar um arquivo, selecione um funcionário...`, {
          title: 'ATENÇÃO!',
          autoHideDelay: 2500,
          appendToast: append,
          variant: 'warning',
        })
      },

      

      // downloadAnexo(row){
      //   let self = this
      //   console.log('->',row)
      //   axios.post('download-anexo', {caminho: row.item.CAMINHO})
      //   .then((response)=>{
      //     console.log('response aqui:', response)
      //   }).catch((error)=> {
      //     console.log('Error: ', error)
      //   })
      // }
    }
  }
  
</script>

<style scoped>

#btn-cadastrar:hover{
  background: blue;
  color: white;
  font-weight: bolder;
  border: none;
}

</style>

<template>
  <div>
    <h1 v-if="temFuncionarioSelecionado == false" class="text-center">Cadastrar Funcionário</h1>
    <h1 v-if="temFuncionarioSelecionado == true" class="text-center">Editar Funcionário</h1>
    <div class="container text-center mt-3">
      <form method="POST">

        <div class="container">
          <b-card>
            <b-tabs content-class="mt-3" no-body>

              <b-tab title="Dados Pessoais" id="dadosPessoais" active no-body>
                <b-row class="my-3">
                  
                  <b-col lg="2">
                    <label for="id">ID Funcionário</label>
                    <b-form-input type="text" v-model="codFuncionario" disabled></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="nome" class="form-label">Nome</label>
                    <input v-model="nome" type="text" name="nome" class="form-control" id="nome">
                  </b-col>

                  <b-col lg="3">
                    <label for="cpf">CPF</label>
                    <b-form-input v-model="cpf" name="cpf" id="cpf"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="nascimento">Dt. nascimento</label>
                    <b-form-input type="date" id="nascimento" v-model="nascimento" name="nascimento" max="9999-12-31"></b-form-input>
                  </b-col>

                </b-row>

                <b-row class="my-3">

                  <b-col lg="4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" v-model="email" name="email" class="form-control" id="email">
                  </b-col>

                  <b-col lg="4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" v-model="telefone" name="telefone" class="form-control" id="telefone">
                  </b-col>

                  <b-col lg="4">
                    <label for="sexo" class="form-label">Sexo</label>
                    <b-form-select type="text" :options="optionsSexo" v-model="sexo" name="sexo" class="form-control" id="sexo"></b-form-select>
                  </b-col>

                </b-row>

                <b-row class="my-3">

                  <b-col lg="2">
                    <label for="cep">CEP</label>
                    <b-form-input @change="buscaCep()" v-model="cep" id="cep"></b-form-input>
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
                    <label for="complemento">Complemento</label>
                    <b-form-input v-model="complemento" id="complemento"></b-form-input>
                  </b-col>

                </b-row>

                <b-row class="my-3 mb-4">

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
                    
                <h5 class="mb-4">Contatos adicionais</h5>

                <b-row class="my-3">

                  <b-col lg="3">
                    <label for="parentescoContatoAdicional1" class="form-label">Grau de parentesco</label>
                    <b-form-select id="parentescoContatoAdicional1" :options="optionsParentesco" v-model="parentescoContatoAdicional1"></b-form-select>
                  </b-col>

                  <b-col lg="4">
                    <label for="nomeContatoAdicional1" class="form-label">Nome</label>
                    <b-form-input type="text" id="nomeContatoAdicional1" v-model="nomeContatoAdicional1"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="telefoneContatoAdicional1" class="form-label">Telefone</label>
                    <b-form-input type="text" id="telefoneContatoAdicional1" v-model="telefoneContatoAdicional1"></b-form-input>
                  </b-col>
                  
                  <b-col lg="2" class="mt-2"><br>
                    <b-row class="m-0">
                      <b-col lg="12">
                        <b-form-checkbox @change="addCampoDeContato()" value="1" unchecked-value="0" v-model="contatoAdicional">Add Contato</b-form-checkbox>
                      </b-col>
                    </b-row>
                  </b-col>

                </b-row>

                <b-row class="my-3" v-if="contatoAdicional == 1">

                  <b-col lg="4">
                    <label for="parentescoContatoAdicional2" class="form-label">Grau de parentesco</label>
                    <b-form-select id="parentescoContatoAdicional2" :options="optionsParentesco" v-model="parentescoContatoAdicional2"></b-form-select>
                  </b-col>

                  <b-col lg="4">
                    <label for="nomeContatoAdicional2" class="form-label">Nome</label>
                    <b-form-input type="text" id="nomeContatoAdicional2" v-model="nomeContatoAdicional2"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="telefoneContatoAdicional2" class="form-label">Telefone</label>
                    <b-form-input type="text" id="telefoneContatoAdicional2" v-model="telefoneContatoAdicional2"></b-form-input>
                  </b-col>
                  
                </b-row>

                <b-row class="my-3">

                  <b-col lg="12">
                    <label for="obs" class="form-label">Observação</label>
                    <br><textarea name="obs" v-model="obs" id="obs" rows="5" class="w-100" style="border-radius: 1.0rem;"></textarea>
                  </b-col>
                  
                </b-row>
              </b-tab>

              <b-tab title="Dados Contratuais" no-body>
                <b-row class="my-3">

                  <b-col lg="3">
                    <label for="dtAdmissao" class="form-label">Dt. admissao</label>
                    <b-form-input type="date" v-model="dtAdmissao" name="dtAdmissao" class="form-control" id="dtAdmissao" max="9999-12-31"></b-form-input>
                  </b-col>

                  <b-col lg="3">
                    <label for="cargo">Cargo</label>
                    <b-form-input type="text" id="cargo" v-model="cargo"></b-form-input>
                  </b-col>                  

                  <b-col lg="3">
                    <label for="tipoContrato">Tipo de contrato</label>
                    <b-form-select :options="optionsContrato" v-model="tipoContrato" id="tipoContrato"></b-form-select>
                  </b-col>

                  <b-col lg="3">
                    <label for="comissaoFixa" class="form-label">Comissão fixa</label>
                    <b-input-group append="%">
                      <b-form-input v-model="comissaoFixa" id="comissaoFixa"></b-form-input>
                    </b-input-group>
                  </b-col>
                    
                </b-row>

                <b-row class="my-3">

                  <b-col lg="4">
                    <label for="ctps">CTPS</label>
                    <b-form-input v-model="ctps" id="ctps"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="pispasep">PIS/PASEP</label>
                    <b-form-input v-model="pispasep" id="pispasep"></b-form-input>
                  </b-col>

                  <b-col lg="4">
                    <label for="passagem" class="form-label">Passagem</label>
                    <b-input-group prepend="R$">
                      <b-form-input v-model="passagem" id="passagem"></b-form-input>
                    </b-input-group>
                  </b-col>
                  
                </b-row>
              </b-tab>

              <b-tab title="Informações financeiras" no-body>
                <b-row class="my-3">

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

                <b-row class="my-3">

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
                    <b-form-select type="text" v-model="tipoConta" name="tipoConta" :options="optionsTipoConta" class="form-control" id="tipoConta"></b-form-select>
                  </b-col>

                </b-row>

                <b-row class="my-3">
                
                  <b-col lg="3">
                    <label for="pix">Escolha o tipo da chave</label>
                    <b-form-select type="text" :options="optionsFormasPix" v-model="formasPix" class="form-control" id="pix"></b-form-select>
                  </b-col>

                  <b-col lg="3" v-if="this.formasPix != null">
                    <label for="chave">PIX</label>
                    <b-form-input type="text" v-model="chave" class="form-control" id="chave"></b-form-input>
                  </b-col>

                </b-row>
              </b-tab>

              <b-tab title="Anexos" no-body>
                <b-row>

                  <b-col lg="3" class="mt-4">
                    <b-input-group>
                      <b-form-select v-model="tipoDoc" :options="optionsTipoDocumentoAnexo">
                        <template #first>
                          <b-form-select-option :value="null" disabled>Tipo documento</b-form-select-option>
                        </template>
                      </b-form-select>
                      <b-input-group-append>
                          <b-button data-bs-toggle="tooltip" title="Limpar documento" variant="outline-primary" @click="limpaTipoDocumento()">
                              <b-icon icon="arrow-counterclockwise" aria-hidden="true"></b-icon>
                          </b-button>
                      </b-input-group-append>
                    </b-input-group>
                  </b-col>

                  <b-col lg="7">
                    <label for=""></label><br>
                    <b-form-file
                      v-model="file1"
                      :state="Boolean(file1)"
                      placeholder="Selecione um arquivo ou solte aqui..."
                      drop-placeholder="Solte o arquivo aqui..."
                      enctype="multipart/form-data"
                      accept=".jpg, .png, .pdf, .jpeg"
                    ></b-form-file>
                  </b-col>
                  
                  <b-col lg="2" class="mt-4">
                    <b-button title="Save file" @click.prevent="uploadProfileImage()" variant="outline-primary">
                      <b-icon icon="cloud-upload" aria-hidden="true"></b-icon>
                    </b-button>
                  </b-col>

                </b-row>

                <b-row class="my-3">

                  <div class="col-lg-12 p-1" v-if="temFuncionarioSelecionado == true">
                    <b-table hover outlined responsive
                      id="anexos-table"
                      head-variant="light"
                      :busy="isBusyTableAnexos"
                      :fields="fieldsAnexos"
                      :items="arrayFotos"
                      per-page="10"
                      :current-page="currentPageAnexos">
                      <template #table-busy>
                        <div class="text-center text-primary my-2">
                          <b-spinner class="align-middle"></b-spinner>
                          <strong>Carregando...</strong>
                        </div>
                      </template>

                      <template #cell(acoes)="row">
                        <b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Visualizar arquivo" variant="outline-primary" v-b-modal.modal-view-anexo>
                          <b-icon icon="eye" @click.prevent="selecionaAnexo(row)"></b-icon>
                        </b-button>
                        
                        <b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Deletar arquivo" variant="outline-primary">
                          <b-icon icon="trash" @click.prevent="deletaAnexo(row)"></b-icon>
                        </b-button>
                        
                        <!--<b-button size="sm" class="m-1 p-1" data-bs-toggle="tooltip" title="Baixar arquivo" variant="outline-primary">
                          <b-icon icon="download" @click.prevent="downloadAnexo(row)"></b-icon>
                        </b-button> -->
                      </template>
                    </b-table>
                  </div> 
                  <div class="col col-lg-12 mt-0 pt-0" v-if="temFuncionarioSelecionado == true">
                    <div class="justify-content-end d-flex mt-0 pt-0">
                      <small class="text-muted mt-0 pt-0"><p>{{rowsAnexos}} registros encontrados.</p></small>
                    </div>
                  </div>
                  <div class="col col-lg-12 mt-1" v-if="temFuncionarioSelecionado == true">
                    <div class="justify-content-center d-flex">
                      <b-pagination
                          v-model="currentPageAnexos"
                          :total-rows="rowsAnexos"
                          per-page="10"
                          aria-controls="produtos-desativados-table">
                      </b-pagination>
                    </div>
                  </div>
                </b-row>

              </b-tab>

            </b-tabs>
          </b-card>
        </div>

        <div class="row">
          <div class="col">
            <div class="mb-3">
              <b-button variant="light" v-if="temFuncionarioSelecionado == false" @click.prevent="salvaFuncionario()" id="btn-cadastrar">Cadastrar</b-button>
              <b-button variant="success" v-if="temFuncionarioSelecionado == true" @click.prevent="editaFuncionario()" id="btn-cadastrar">Editar</b-button>
              <b-button variant="danger" v-if="temFuncionarioSelecionado == true" @click.prevent="excluiFuncionario()" id="btn-cadastrar">Deletar</b-button>
              <div style="font-size: 3.3rem;" v-if="temFuncionarioSelecionado == true || this.nome != null">
                <b-button pill variant="primary" @click.prevent="limpaDados()" id="btn-cadastrar">Limpar</b-button>
              </div>
            </div>
          </div>
        </div>

      </form>
    
      <div>
        <b-button variant="light" id="btn-cadastrar" v-b-modal.info-Funcionarios>Consultar Funcionários</b-button>
      </div>

    </div>

    <b-modal id="info-Funcionarios" size="lg">
      <h1 class="text-center">Consulta de Funcionarios</h1>
      <div class="container">
        <b-table 
        striped hover 
        :items="itemsFuncionarios" 
        :fields="fieldsFuncionarios" 
        houver 
        outlined 
        responsive
        :per-page="perPageFuncionarios"
        :current-page="currentPageFuncionarios">
          
          <template #cell(acoes) ="row">
            <a href=""><b-icon icon="person-circle" font-scale="1" data-bs-toggle="tooltip" title="Visualizar perfil" @click.prevent="selecionaFuncionarios(row)"></b-icon></a>
          </template>
        
        </b-table>
        
        <b-pagination
          align="center"
          v-model="currentPageFuncionarios"
          :total-rows="rowsFuncionarios"
          :per-page="perPageFuncionarios"
          aria-controls="lista-Funcionarios"
        >
        </b-pagination>
      </div>
    </b-modal>

    
    <b-modal id="modal-view-anexo" hide-footer size="xl" scrollable>
      <div class="container-fluid">
        <b-row class="m-2 mt-5">
          <b-col>
            <h4><b>Arquivo: {{arquivo}}</b></h4>
          </b-col>
        </b-row>
        <b-img :src="documentoEscolhido" fluid v-if="tipoDocumentoPdf == false"></b-img>

        <b-embed
          v-if="tipoDocumentoPdf == true"
          type="iframe"
          :src="documentoEscolhido"
        ></b-embed>
      </div>
    </b-modal>

  </div>
</template>