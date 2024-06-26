<script>
    export default {
        data(){
            return{
               escritorio: '../public/images/adm.jpg', 
               borracharia: '../public/images/servicos.jpg', 
               seguros: '../public/images/seguro.png', 
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>

<style scoped>

div#servicos h1{
    margin-left: 0;
    background-color: rgba(218, 218, 218, .5);
    padding: 2px;
    text-align: center;
}

div#servicos h1:hover{
    background-color:blue;
    color:white;
    transition: 1s;
}

aside.texto-lateral h1{
    margin-left: 0;
    background-color: rgba(218, 218, 218, .5);
    padding: 2px;
    text-align: center;
}

aside.texto-lateral h1:hover{
    background-color:blue;
    color:white;
    transition: 1s;
}

div#bordado1{
    border: 2px dotted black;
}

#separacao{
    background-color: rgba(218, 218, 218, .5);
}

#hoverQuadGrande{
    background-color: rgba(218, 218, 218, .5);
    font: bolder black;
    padding: 1.5rem 0.3rem 1.5rem 0.3rem;
}

#hoverQuadGrande:hover{
    background-color:blue;
    color:white;
    transition: 1s;
    transform: scale(1.03);
}

#separacao:hover{
    background-color:blue;
    transition: 1s;
    transform: scale(1.1);
}

div#bordado1:hover{
    background-color:blue;
    color: white;
    transition: 1s;
    transform: scale(.9); 
    border: 2px black; 
}

div#bordado1 h2{
    text-decoration:underline;
}

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
    <section id="areaatuacao">
        <div>
            <hr class="bg-secondary">
            <div id="servicos">
                <h1 class="text-center" style="font-weight: bolder;">Áreas de Atuação</h1>
            </div>
            <hr class="bg-secondary">
        </div> 
        <div  id="quadfora" class="p-7 pt-1 pb-1 mb-1 mt-1 text-dark">
            <div style="font-weight: bold;">
                <div class="row m-2 text-center">
                    <div id="bordado1" class="col p-3 ">
                        <h2>DETRAN</h2><br>
                        Segunda via ATPV-E<br>
                        Transferência de Propriedade<br>
                        Troca de Característica<br>
                        Baixa / Inclusão gravame<br>
                        Troca de Categoria<br>
                    </div>
                    <div id="bordado1" class="col p-3">
                        <h2>SMTR</h2><br>
                        Transferência<br>
                        Permuta<br>
                        Benefício<br>
                        Vistoria Anual<br>
                        Extra
                    </div>
                </div>
            </div> 
        </div>
    </section>
  
    <aside class="texto-lateral">

    <section>
    
        <div class="container w-100">
            <b-row class="my-5 w-100 rounded" id="hoverQuadGrande">
                <b-col lg="7" class="text-center" >
                    <h2 style="font-size: 2.2rem;"><b>Controle Administrativo</b></h2>
                    <br>
                    <p class="ml-4" style="font-size: 2rem;">Obtenha aqui um completo suporte administrativo para seu TAXI <br> com profissionais habilitados e capacitados!</p>
                </b-col>

                <b-col lg="5">
                    <img class="img-fluid mx-auto rounded" :src="require('/xampp/htdocs/SerginhoDoTaxi/public/images/adm.jpg')" alt="imagem">
                </b-col>
            </b-row>

            <b-row class="my-5 w-100 rounded" id="hoverQuadGrande">
                <b-col lg="7" class="text-center">
                    <h2 class="mt-2" style="font-size: 2.2rem;"><b>Serviços Securitários</b></h2>
                    <br>
                    <p class="lead ml-4"><b>Com atuação em diversos ramos e seguradoras!</b></p>
                </b-col>

                <b-col lg="5">
                    <img class="img-fluid mx-auto rounded" :src="require('/xampp/htdocs/SerginhoDoTaxi/public/images/seguro.png')" alt="imagem">
                </b-col>
            </b-row>

            <b-row class="my-5 w-100 rounded" id="hoverQuadGrande">
                <b-col lg="5">
                    <img class="img-fluid mx-auto rounded" :src="require('/xampp/htdocs/SerginhoDoTaxi/public/images/borracharia.jpg')" alt="imagem">
                </b-col>

                <b-col lg="7" class="text-center">
                    <h2 class="mt-2" style="font-size: 2.2rem;"><b>Serviços Automotivos</b></h2>
                    <br>
                    <p class="lead ml-4"><b>Na Serginho do Taxi! você pode contatar com nosso setor de borracharia, que oferece alguns serviços:</b></p>
                    <ul class="lead">
                        <li><b>Balanceamento de Rodas</b></li>
                        <li><b>Venda de Pneus Importados e Nacionais</b></li>
                        <li><b>Reforma e Desempeno de Rodas</b></li>
                        <li><b>Vulcanização Fria e Quente</b></li>
                    </ul>
                </b-col>
            </b-row>

        </div>
       
    </section>
    
  </aside>

 
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
        Copyright &copy; 2022 - by Matheus Noguerol    
        </div> 
    </footer>

  </div>
</template>