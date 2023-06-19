

<script>
    export default {
        data(){
            return{
                nome: null,
                email: null,
                msg: null,
                temNome : false,
                pulse: '../public/images/pulse1.jpg', 
                matheus: '../public/images/fotomatheus22.jpg', 
                serginho: '../public/images/fotosergio22.jpg', 
                alex: '../public/images/fotoalex22.jpg', 
                denilson: '../public/images/fotodenilson22.jpg', 
            }
        },
    }
</script>

<style scoped>
section#cartaofuncionario h3{
    margin-left: 0;
    background-color: rgba(218, 218, 218, .5);
    padding: 2px;
    text-align: center;
}

section#cartaofuncionario h3:hover{
    background-color:blue;
    color:white;
    transition: 1s;
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

div#historia h1{
    margin-left: 0;
    background-color: rgba(218, 218, 218, .5);
    padding: 2px;
    text-align: center;
}

div#historia h1:hover{
    background-color:blue;
    color:white;
    transition: 1s;
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

div#nossotime{
    margin-left: 0;
    background-color: rgba(218, 218, 218, .5);
    padding: 2px;
    text-align: center;
}

div#nossotime:hover{
    background-color:blue;
    color:white;
    transition: 1s;
}

div#cardFunc:hover{
    background-color:blue;
    color:white;
    border: none;
}

div#cardFunc{
    background-color: rgba(218, 218, 218, .6);
}
</style>

<template>
    <div>
        <a href="https://wa.me/5521981443296?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF; border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
        z-index:1000;" target="_blank">
            <i style="margin-top:16px" class="fa fa-whatsapp"></i>
        </a>
        <main class="mb-5">
            <section id="historialoja">

                <hr class="bg-secondary">

                <div id="historia">
                    <h1 class="text-center" style="font-weight: bolder;">História da Serginho do Taxi</h1>
                </div>

                <hr class="bg-secondary">
              
                <div class="container w-100">
                    <b-row class="my-5 rounded" id="hoverQuadGrande">
                        <b-col lg="7" class="text-center">
                            <h3>
                            <p ><b>No ano de 1973 nascia o CEO da Serginho do Taxi, o Sergio Couto ou popularmente conhecido como "Serginho".</b></p>

                            <p><b>Sua vida profissional começou muito cedo, e logo ele se tornou taxista seguindo os passos de seu pai. Após um tempo dirigindo seu taxi, começou a resolver a parte burocrática da documentação e a partir daí essa era sua nova fonte de renda, se expandindo para serviços automotivos em geral se mantendo até os dias de hoje.</b></p>
                            </h3>
                        </b-col>

                        <b-col lg="5">
                            <img :src="pulse" class="img-fluid mx-auto rounded" alt="">
                        </b-col>
                    </b-row>
                </div>
                
            </section>

            <hr class="bg-secondary w-100">

           <div id="Team-area">
                <div class="col-12" id="nossotime">
                    <h1 class="main-title" style="font-weight:bolder">NOSSO TIME</h1>
                </div>
                <hr class="bg-secondary">
            
                <b-card-group class="mx-1" rounded>
                    <b-card id="cardFunc" :img-src="serginho" img-alt="Image" img-top class="mx-1" rounded >
                        <div>
                            <b-card-text>
                                <p><b>Sergio Couto</b></p>
                                <p><i>CEO</i></p>
                                
                            </b-card-text>
                        </div>
                    </b-card>

                    <b-card id="cardFunc" :img-src="matheus" img-alt="Image" img-top class="mx-1" rounded>
                        <b-card-text>
                            <p><b>Matheus Noguerol</b></p>
                            <p><i>Corretor</i></p>
                            
                        </b-card-text>
                    </b-card>

                    <b-card id="cardFunc" :img-src="alex" img-alt="Image" img-top class="mx-1" rounded>
                        <b-card-text>
                            <p><b>Alex Pereira</b></p>
                            <p><i>Despachante</i></p>
                            
                        </b-card-text>
                    </b-card>

                    <b-card id="cardFunc" :img-src="denilson" img-alt="Image" img-top class="mx-1" rounded>
                        <b-card-text>
                            <p><b>Denilson Barbosa</b></p>
                            <p><i>Despachante</i></p>
                            
                        </b-card-text>
                    </b-card>
                </b-card-group>
           </div>
        </main>

        
        <footer id="rodape">
            <section>
                <div class="card text-center bg-dark bg-opacity-10">
                    <div id="call-area">
                    <div class="card-body">
                        <h5 class="card-title">Acesse o site de integração da prefeitura com o cidadão.</h5>
                        <span class="direita">Clique no botão abaixo para ser redirecionado.</span><br>
                        <a href="http://carioca.rio" class="btn btn-primary">Carioca Digital</a>
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

