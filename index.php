<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Repositório</title>

        <!-- Bootstrap -->
        <link href="css/bootstraps.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!--Main css-->
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Caesar+Dressing|Montserrat:400,700|Open+Sans|Righteous"
              rel="stylesheet">
        <style>
            .login{
                width: 25%;
            }
        </style>
    </head>
    <body data-spy="scroll" data-offset="80">
        <section id="home">
            <div class="bg-color"><br/>
                <a href="app/"><button type="button" class="btn btn-primary pull-right login" name="btn_pesquisa">Login</button></a>
                <div class="container">
                    <div class="row banner-content">
                        <div
                            class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                            <div class="banner-inner text-center">
                                <span class="imagem"><img src="img/projecao.png"/></span>
                                <header class="card-header bg-white">
                                    <h1>Repositorio</h1>
                                </header>
                                <form action="pesquisa.php" method="post">
                                    <hr class="w-75">
                                    <input class="" type="text" class="form-control" name="pesquisa" 
                                           placeholder="Digite sua pesquisa" 
                                           oninvalid="setCustomValidity('Campo obrigatório para pesquisar')" 
                                           onchange="try {
                                                                                    setCustomValidity('')
                                                                                } catch (e) {
                                                                                }" required/>
                                    <button type="submit" class="btn btn-primary" name="btn_pesquisa">Pesquisar</button>
                                    <hr class="w-75">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </body>
</html>