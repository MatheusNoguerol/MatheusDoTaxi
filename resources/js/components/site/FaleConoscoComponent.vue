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

<style scoped>
#call-area{
    background-color:rgba(0, 0, 255, 0.8);
    text-align: center;
    padding: 10px;
    color: white;
}

div#bordado{
    border: 1px solid black;
    
}

div#bordado:hover{
    background-color:blue;
    color: white;
    transition: 1s;
    transform: scale(1.1);
}

div#quadfora{
    background-color: rgba(218, 218, 218, .8);
}
</style>

<template>
<div>
  <a href="https://wa.me/5521981443296?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF; border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
  z-index:1000;" target="_blank">
    <i style="margin-top:16px" class="fa fa-whatsapp"></i>
  </a>

  <div class="container text-center mt-3">    
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
  </div>
    
  <footer id="rodape">
    <section>
        <div class="card text-center bg-dark bg-opacity-10">
            <div id="call-area">
            <div class="card-body">
                <h5 class="card-title">Acesse o site de integração da prefeitura com o cidadão.</h5>
                <span class="direita">Clique no botão abaixo para ser redirecionado.</span><br>
                <a href="http://carioca.rio" class="btn btn-primary">Carioca Digital</a><!--AQUI ENTRA BOTAO QUE LEVA PARA FORMULARIO DE ATENDIMENTO REMOTO-->
            </div>
            </div>
        </div>
    </section>

    <div  id="quadfora" class="p-7 pt-2 pb-2 mb-2 mt-1 text-dark">
        <div  class=" text-center" style="font-weight: bold;">
            <div class="row m-2">
                <div id="bordado" class="col p-3">
                    Contato<br>
                    (21)98144-3296<br>
                    (21)3936-4967
                </div>
                <div id="bordado" class="col p-3">
                    Horarios<br>
                    Segunda à Sexta<br>
                    09:00 às 17:00
                </div>
                <div id="bordado" class="col p-3">
                    Localizacao<br>
                    Rua Padre Manoel da Nobrega 1166<br>
                    quintino 
                    21321-009
                </div>
                <div id="bordado" class="col p-3">
                    Sigam a gente nas redes sociais:<br>
                    Instagram<br>  Facebook
                </div>
            </div>
        </div> 
    </div>
    
    <div class="card-footer text-muted text-center mb-2">
    Copyright 2022 - by Matheus Noguerol    
        <a target="_blank" href="https://www.facebook.com/matheus.noguerol">Facebook</a>
        <a target="_blank" href="https://www.instagram.com/noguerolmatheus/?hl=pt-br">Instagram</a>
    </div> 
  </footer>
</div>
</template>

