<script>
    export default {
        data(){
            return{
                nome: null,
                email: null,
                msg: null,
                temNome : false,
                fotoFrenteLoja: '../public/images/frenteloja.jpeg',
                avaliacoes: '../public/images/avaliacoes.png',
                comentarios2: '../public/images/comentarios2.png',
            }
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

div#mapa-geral:hover{
    background-color:blue;
    color: white;
    transition: 1s;
    transform: scale(1.1);
    text-align: center;
    font-weight: bolder;
}

div#mapa-geral{
    background-color: rgba(218, 218, 218, .5);
    text-align: center;
    font-weight: bolder;
}

span#visita{
    font-size: 1.5rem;
}

div#sombraFoto{
    background-color: rgba(218, 218, 218, .5);
    padding: 2rem;

}

#coments{
    background-color: rgba(218, 218, 218, .5);
    padding: 2rem;  
}

#coments:hover{
   background-color:blue;
   transition: 1s;
}

#mapa{
    background-color: rgba(218, 218, 218, .5);
    padding: 2rem;  
}


</style>

<template>
    <div>
        <section class="mb-3">
            <hr class=bg-secondary>
            <div id="mapa-geral">
                <span id="visita">Faça-nos uma VISITA e se SURPREENDA com nosso atendimento.<br>
                Localize-se através do mapa abaixo, NÃO TEM ERRO!</span>
            </div>
            <hr class=bg-secondary>
            <div class="row m-auto container">
                <div id="sombraFoto" class="col col-md-12 overflow-hidden rounded" style="display:grid; font-weight: bold; text-align: center;">
                    <img :src="fotoFrenteLoja " class="img-fluid" alt="...">
                </div>
            </div>  
            <br>
        </section>
        <div class="row m-auto" id="mapa">
            <div class="col col-md-12 overflow-hidden" style="display:grid; font-weight: bold; text-align: center;">
                <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3675.999408694295!2d-43.319209848851045!3d-22.876480242469473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997da14bddeb2b%3A0x8cc28573c685bff0!2sSerginho%20do%20Taxi!5e0!3m2!1spt-BR!2sbr!4v1667482244479!5m2!1spt-BR!2sbr" height="300" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
            </div>
        </div>



        <div class="container w-100 mb-5 mt-5 rounded" id="coments">
            <b-row class="my-5 w-100 rounded text-center" id="hoverQuadGrande">
                <b-col lg="6">
                    <img :src="avaliacoes" class="img-fluid mx-auto rounded" alt="">
                </b-col>
                <b-col lg="6">
                    <img :src="comentarios2" class="img-fluid mx-auto rounded" alt="">
                </b-col>
            </b-row>
        </div>

        
        <a href="https://wa.me/5521981443296?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF; border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
        z-index:1000;" target="_blank">
            <i style="margin-top:16px" class="fa fa-whatsapp"></i>
        </a>

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