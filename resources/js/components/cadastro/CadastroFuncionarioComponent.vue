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
            key: '',
            label: '',
            sortable: true
          },
          {
            key: '',
            label: '',
            sortable: true
          },
          {
            key: '',
            label: '',
            sortable: true
          }
        ]
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
      rowsClientes() {
        return this.itemsClientes.length
      }
    },

    mounted() {
      console.log('Component mounted.')
    },

    methods: {
      addCampoDeContato(){
        let self = this 

        self.temContatoAdicional = true
      },

      salvaFuncionario(){
        let self = this

        axios.post('salva-funcionario', {
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
          console.log("Response: ", response)
        }).catch((error) => {
          console.log("Error: ", error)
        })
      }
    }
  }
</script>


<template>
   <div>
      <h1 v-if="temFuncionarioSelecionado == false" class="text-center">Cadastrar Funcionário</h1>
      <h1 v-if="temFuncionarioSelecionado == true" class="text-center">Editar Funcionário</h1>
      <div class="container text-center mt-3">
        <form method="POST">

          <div class="container">
            <b-card>
              <b-tabs content-class="mt-3" no-body>

                <b-tab title="Dados Pessoais" active no-body>
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
                      <b-form-input v-model="cep" id="cep"></b-form-input>
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
                    
                    <b-col lg="2">
                      <label for="">+ Campo</label>
                      <b-form-radio @change="addCampoDeContato()" v-model="contatoAdicional"></b-form-radio>
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
                <input type="submit" value="Cadastrar" @click.prevent="salvaFuncionario()">
                <b-button variant="primary" v-if="temFuncionarioSelecionado == true" @click.prevent="EditaFuncionario()">Editar</b-button>
                <b-button variant="danger" v-if="temFuncionarioSelecionado == true" @click.prevent="ExcluiFuncionario()">Deletar</b-button>
                <div style="font-size: 3.3rem;" v-if="temFuncionarioSelecionado == true">
                  <b-button pill @click.prevent="limpaDados()">Limpar</b-button>
                </div>
              </div>
            </div>
          </div>

        </form>
      
        <div>
          <b-button variant="outline-primary" @click.prevent="abreModal()">Consultar Funcionários</b-button>
        </div>

      </div>

    <b-modal id="info-Funcionarios" size="xl">
      <h1 class="text-center">Consulta de Funcionarios</h1>
      <div class="container">
        <b-table 
        striped hover 
        :items="itemsFuncionarios" 
        :fields="fieldsFuncionarios" 
        houver 
        outlined 
        responsive>
        <template #cell(acoes) ="row">
          <a href=""><b-icon icon="person-circle" font-scale="1" data-bs-toggle="tooltip" title="Visualizar perfil" @click.prevent="SelecionaFuncionarios(row)"></b-icon></a>
        </template>
        </b-table>
      </div>
    </b-modal>

  </div>
</template>