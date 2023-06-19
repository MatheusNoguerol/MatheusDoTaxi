<script>
    export default {
      data(){
        return{                                   
          idDC: null,
          nomeDC: null,
          cpfCnpjDC: null,
        }
      },
      props: {
        user: {
          type: String,
          default: '',
          required: true
        },
      },
      mounted() {
          console.log('Component mounted.')
      },
    }
</script>


<template>  
    <div>
        <h1 class="text-center">Consulta de Cadastros</h1>
        <b-row class="my-2">
                  
        <b-col lg="2">
          <label for="id">ID</label>
          <b-form-input type="text" v-model="idDC" disabled></b-form-input>
        </b-col>

        <b-col lg="4">
          <label for="nome" class="form-label">Nome</label>
          <input v-model="nomeDC" disabled type="text" name="nome" class="form-control" id="nome">
        </b-col>

        <b-col lg="3">
          <label for="cpfCnpj">CPF / CNPJ</label>
          <b-form-input v-model="cpfCnpjDC" disabled name="cpfCnpj" id="cpfCnpj"></b-form-input>
        </b-col>
        <hr class="bg-secondary w-100 p-0 m-0 mt-3">
      </b-row>
    </div>
</template>