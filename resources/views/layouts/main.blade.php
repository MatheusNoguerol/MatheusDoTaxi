<!doctype hmtl>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/img/logobarra.png"/>
    <script src="/js/script.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg" id="cabecalho">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/">
        <img src="/img/logobarra.png"/>
      </a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/quemSomos">Quem somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/multimidia">Multimídia</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/localizacao">Localização</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/faleConosco">Fale conosco</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div id="botaozap">
    <a href="https://wa.me/5521981443296?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;       border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888;
    z-index:1000;" target="_blank">
      <i style="margin-top:16px" class="fa fa-whatsapp"></i>
    </a>
  </div>
  
  <div id="app">
    @yield('content')
  </div>
  
  <footer id="rodape">
    <section>
      <div class="card text-center bg-dark bg-opacity-10">
        <div id="call-area">
          <div class="card-body">
            <h5 class="card-title">Acesse o site de integração da prefeitura com o cidadão.</h5>
            <span class="direita">Clique no botão abaixo para ser redirecionado.</span><br>
            <br><a href="http://carioca.rio" class="btn btn-primary">Carioca Digital</a>
          </div>
        </div>
      </div>
    </section>
    
    <div  id="quadfora" class="text-dark pt-2">
      <div  class=" text-center" style="font-weight: bold;">
        <div class="row m-2">
          <div id="bordado" class="col p-2">
            Contato<br>
            (21)98144-3296<br>
            (21)3936-4967
          </div>
          <div id="bordado" class="col p-2">
            Horarios<br>
            Segunda à Sexta<br>
            09:00 às 17:00
          </div>
          <div id="bordado" class="col p-2">
            Localizacao<br>
            Rua Padre Manoel da Nobrega 1166<br>
            quintino 
            21321-009
          </div>
          <div id="bordado" class="col p-2">
            Sigam a gente nas redes sociais:<br>
            Instagram<br>  Facebook
          </div>
        </div>
      </div> 
      <div class="card-footer text-muted text-center">
          Copyright 2022 - by Matheus Noguerol    
          <a target="_blank" href="https://www.facebook.com/matheus.noguerol">Facebook</a>
          <a target="_blank" href="https://www.instagram.com/noguerolmatheus/?hl=pt-br">Instagram</a>
      </div> 
    </div>
    
  </footer>
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    


</body>
</html>