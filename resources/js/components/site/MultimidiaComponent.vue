<script>
    export default {
        data(){
            return{
                nome: null,
                email: null,
                msg: null,
                temNome : false,
                spinBranca: '../public/images/spinbranca22.jpg',
                onix: '../public/images/onixlacohd22.jpg',
                pulse: '../public/images/pulsefrontal22.jpg',
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

div#carousel{
    background-color: rgba(218, 218, 218, .5);
    padding: 2rem;
}

div#midias{
    margin-left: 0;
    background-color: rgba(218, 218, 218, .5);
    padding: 2px;
    text-align: center;
}

div#midias:hover{
    background-color:blue;
    color:white;
    transition: 1s;
}

</style>

<template>
    <div>
        <hr class="bg-secondary w-100">

        <div id="midias">
            <h1 class="text-center" style="font-weight: bolder;">Multimídia</h1>
        </div>

        <hr class="bg-secondary w-100">

        <div id="carousel" style="max-width: 800px;" class="m-auto">
            <b-carousel
            id="carousel-fade"
            style="text-shadow: 0px 0px 2px #000"
            fade
            controls
            img-width="1024"
            img-height="480">
                <b-carousel-slide
                caption-html="<h2><b>SPIN</b></h2>"
                :img-src="spinBranca"
                ></b-carousel-slide>
                <b-carousel-slide
                caption-html="<h2><b>ONIX</b></h2>"
                :img-src="onix"
                ></b-carousel-slide>
                <b-carousel-slide
                caption-html="<h2><b>PULSE</b></h2>"
                :img-src="pulse"
                ></b-carousel-slide>
            </b-carousel>
        </div>
        <div class="container mt-3 mb-5 rounded" id="carousel">
            <b-embed
            class="pr-3 pl-3"
            type="iframe"
            aspect="16by9"
            src="https://www.youtube.com/embed/rd0li5LrHls"
            allowfullscreen></b-embed>
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