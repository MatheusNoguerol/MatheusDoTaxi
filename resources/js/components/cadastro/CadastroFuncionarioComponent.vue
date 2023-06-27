<script>
  export default {
    data(){
      return{
        temFuncionarioSelecionado: false,
        id: null,
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
        id: null
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
      }
    },

    mounted() {
      let self = this 

      self.preLoad()
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

      addCampoDeContato(){
        let self = this 

        self.temContatoAdicional = true
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
        
        axios.post('salva-funcionario', {
          id: self.id,
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
          formasPix: self.formasPix
        }).then((response) => {
          
          self.preLoad()
          self.makeToastSalvaFuncionario()
          self.limpaDados()
              
        }).catch((error) => {
          console.log("Error: ", error)
        })
      },

      selecionaFuncionarios(row){
        let self = this 

        self.id = row.item.ID
        
        axios.post('seleciona-dados-extras-funcionarios',{id: self.id})
        .then((response) => {
          
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
          
          if(response.data.length == 0){
            self.temFuncionarioSelecionado = true
            self.temContatoAdicional = true
            this.$bvModal.hide('info-Funcionarios')
          }

          self.dtAdmissao = response.data[0].DTADMISSAO
          self.cargo = response.data[0].CARGO
          self.tipoContrato = response.data[0].TIPOCONTRATO
          self.comissaoFixa = response.data[0].COMISSAOFIXA
          self.ctps = response.data[0].CTPS
          self.pispasep = response.data[0].PISPASEP
          self.passagem = response.data[0].PASSAGEM

          self.nmrbanco = response.data[0].NOBANCO
          self.banco = response.data[0].BANCO
          self.agencia = response.data[0].AGENCIA
          self.conta = response.data[0].CONTA
          self.titular = response.data[0].TITULAR
          self.cpfTitular = response.data[0].CPFTITULAR
          self.tipoConta = response.data[0].TIPO
          self.chave = response.data[0].CHAVEPIX
          self.formasPix = response.data[0].TIPOCHAVE

          self.temFuncionarioSelecionado = true
          
          self.temContatoAdicional = true

          this.$bvModal.hide('info-Funcionarios')
        }).catch((error) => {
          console.log("Error: ", error)
        })

      },

      editaFuncionario(){
        let self = this

        axios.post('edita-funcionario', {
          id: self.id,
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

      limpaDados(){
        let self = this
        
        self.id = null
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
                      <label for="id">ID</label>
                      <b-form-input type="text" v-model="id" disabled></b-form-input>
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
                        <b-col lg="6">
                          <small>Add</small>
                        </b-col>
                        <b-col lg="6">
                          <b-form-checkbox @change="addCampoDeContato()" value="1" unchecked-value="0" v-model="contatoAdicional"></b-form-checkbox>
                        </b-col>
                      </b-row>
                    </b-col>

                  </b-row>

                  <b-row class="my-3" v-show="temContatoAdicional">

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

              </b-tabs>
            </b-card>
          </div>

          <div class="row">
            <div class="col">
              <div class="mb-3">
                <b-button variant="light" v-if="temFuncionarioSelecionado == false" @click.prevent="salvaFuncionario()" id="btn-cadastrar">Cadastrar</b-button>
                <b-button variant="success" v-if="temFuncionarioSelecionado == true" @click.prevent="editaFuncionario()" id="btn-editar">Editar</b-button>
                <b-button variant="danger" v-if="temFuncionarioSelecionado == true" @click.prevent="excluiFuncionario()" id="btn-excluir">Deletar</b-button>
                <div style="font-size: 3.3rem;" v-if="temFuncionarioSelecionado == true">
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

    <b-modal id="info-Funcionarios" size="md">
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

  </div>
</template>