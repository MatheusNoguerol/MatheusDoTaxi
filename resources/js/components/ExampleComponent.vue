<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.

                    </div>

                    <b-button>Button</b-button>
                    <input type="text" name="" id="">
                    <h1 v-show="temNome">{{nome}}</h1>


                    <b-list-group>
                        <b-list-group-item href="#some-link" @click="teste()">Awesome link</b-list-group-item>
                        <b-list-group-item href="#" active>Link with active state</b-list-group-item>
                        <b-list-group-item href="#">Action links are easy</b-list-group-item>
                        <b-list-group-item href="#foobar" disabled>Disabled link</b-list-group-item>
                    </b-list-group>
                </div>
            </div>
        </div>

        
          <form method="POST" action="/form" @submit.prevent="saveData"> 
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input v-model="nome" type="text" name="nome" class="form-control" id="nome" placeholder="Digite seu nome">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" v-model="email" name="email" class="form-control" id="email" placeholder="Digite seu email">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="msg" class="form-label">Mensagem</label>
            <br><textarea name="msg" v-model="msg" id="msg" rows="5" class="w-100" style="border-radius: 1.0rem;" placeholder="Digite aqui sua mensagem..."></textarea>
          </div>
        </div>  
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <input type="submit" value="Enviar" @click.prevent="teste">
          </div>
        </div>
      </div>
    </form>
        
    {{nome}}
    {{email}}
    {{msg}}
    </div>
</template>

<script>
    export default {
        data(){
            return{
                nome: null,
                email: null,
                msg: null,
                temNome : false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            teste(){
              console.log(this.nome)
              axios.post('save_student',{
                nome : this.nome,
                email : this.email,
                msg : this.msg
              })
              .then(response => console.log(response));
            },
        },
        
    }
</script>
