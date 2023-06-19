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
        dtAdmissao: null,
        cargo: null,
        tipoContrato: null,
        comissaoFixa: null,
        nmrbanco: null,
        banco: null,
        agencia: null,
        conta: null,
        titular: null,
        cpfTitular: null,
        tipoConta: null,
        parentescoContatoAdicional1: null,
        nomeContatoAdicional1: null,
        telefoneContatoAdicional1: null,
        optionsParentesco: [
          { value: 'conjuge', text: 'Cônjuge' },
          { value: 'irmao', text: 'Irmão'},
          { value: 'outro', text: 'Outro'}
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
                      <label for="cpf">CPF</label>
                      <b-form-input v-model="cpf" name="cpf" id="cpf"></b-form-input>
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

                  </b-row>

                  <b-row class="my-2">

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

                  <b-row class="my-2 mb-4">

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

                  <hr class="bg-secondary">
                  <small>Contatos adicionais</small>

                  <b-row class="my-2">

                    <b-col lg="4">
                      <label for="parentescoContatoAdicional1" class="form-label">Grau de parentesco</label>
                      <b-form-select id="parentescoContatoAdicional1" :options="optionsParentesco" v-model="parentescoContatoAdicional1"></b-form-select>
                    </b-col>

                    <b-col lg="4">
                      <label for="nomeContatoAdicional1" class="form-label">Nome</label>
                      <b-form-input type="text" id="nomeContatoAdicional1" v-model="nomeContatoAdicional1"></b-form-input>
                    </b-col>

                    <b-col lg="4">
                      <label for="telefoneContatoAdicional1" class="form-label">Telefone</label>
                      <b-form-input type="text" id="telefoneContatoAdicional1" v-model="telefoneContatoAdicional1"></b-form-input>
                    </b-col>
                    
                  </b-row>

                  <b-row class="my-2">

                    <b-col lg="12">
                      <label for="obs" class="form-label">Observação</label>
                      <br><textarea name="obs" v-model="obs" id="obs" rows="5" class="w-100" style="border-radius: 1.0rem;"></textarea>
                    </b-col>
                    
                  </b-row>
                </b-tab>


                <b-tab title="Dados Contratuais" no-body>
                  <b-row class="my-2">

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
                          <label for="comissaoFixa" class="form-label">Comissões fixas</label>
                          <b-input-group append="%">
                          <b-form-input v-model="comissaoFixa" id="comissaoFixa"></b-form-input>
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
                <input type="submit" value="Cadastrar" v-if="temClienteSelecionado == false" @click.prevent="salvaCliente">
                <b-button variant="primary" v-if="temClienteSelecionado == true" @click.prevent="EditaCliente()">Editar</b-button>
                <b-button variant="danger" v-if="temClienteSelecionado == true" @click.prevent="ExcluiCliente()">Deletar</b-button>
                <div style="font-size: 3.3rem;" v-if="this.nome != null || this.email != null || this.placa != null || this.telefone != null || this.telefone != null || this.nascimento != null || this.vencApolice != null || this.msg != null">
                  <b-button pill @click.prevent="limpaDados">Limpar</b-button>
                </div>
              </div>
            </div>
          </div>

        </form>
      
        <div>
          <b-button variant="outline-primary" @click.prevent="abreModal()">Consultar Clientes</b-button>
        </div>

      </div>

    <b-modal v-model="modalShow" id="info-cliente" size="xl">
      <h1 class="text-center">Consulta de Clientes</h1>
      <div class="container">
        <b-table 
        striped hover 
        :items="itemsClientes" 
        :fields="fieldsClientes" 
        houver 
        outlined 
        responsive>
        <template #cell(acoes) ="row">
          <a href=""><b-icon icon="person-circle" font-scale="1" data-bs-toggle="tooltip" title="Visualizar perfil" @click.prevent="SelecionaCliente(row)"></b-icon></a>
        </template>
        </b-table>
      </div>
    </b-modal>

  </div>
</template>