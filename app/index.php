<!DOCTYPE html>
<html lang="PT-BR">
<head>
<meta charset="UTF-8">
<title>Login</title>
<!-- CDN BS Primeiro, caso não funcione, Bootstrap local -->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">  
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/styleIndex.css">
</head>

<body>
    <header class="collapse" id="navToggle">
        <div class="bg-dark p-4">
          <nav class="navbar navbar-dark bg-dark">
            
          </nav>
        </div>
      </header>
  
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navToggle" aria-controls="navToggle" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
            <a class="navbar-brand" href="../">Repositorio</a>
            <div class="collapse navbar-collapse">
                <div class="btn-group" role="group">
              <a class="btn btn-secondary" href="../" role="button">voltar</a>
            </div>
          </div>
        </div>
      </nav>

<section class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-10 text-center escopo mx-auto">
  <span class="imagem"><img src="../img/projecao.png"/></span>
  <header class="card-header bg-white">
    <h1>Repositorio</h1><span>Login</span>
  </header>
  
    <!-- tela de login -->
    <form name="formAcessar" method="post" action="login.php">
      <hr class="w-75">
      <input class="col-11" type="text" name="usuario" placeholder="Matrícula" required/>
      <input class="col-11" type="password" name="senha" placeholder="Senha" required/>
      <button class="col-11 btn-primary">login</button>
      <hr class="w-75">
    </form>
  
</section>

  <!-- scripts para animação -->
  <!-- CDN primeiro, caso não funcione, JQuery & BS local -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>          
  <script src="../js/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="../js/popper.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='../js/jquery.min.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script  src="../js/index.js"></script>

</body>

</html>
