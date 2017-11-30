
<?php
//caso a sessao estiver iniciada redirecionará para principal.php
session_start();
if (!(isset($_SESSION['login']))) {
    header('Location: admin.php');
}
?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Painel Administrativo</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />
        <link rel="icon" href="icone.ico" type="image/x-icon" />
    </head>

    <link rel="stylesheet" href="stylePrincipal.css">
    <body>
        <div class="page-header" align="center" >
            <h1> Painel Adminstrador NWD</h1> 
            <h2> <small>Página Administrativa</small></h2>
        </div>



        <div class="container theme-showcase" role="main">



            <nav class="navbar navbar-default">

                <div class="container-fluid">



                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                        <ul class="nav navbar-nav navbar-left">

                            <li>
                                <a href="admin.php" >
                                    Início</a>

                            </li>


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">


                                    Capa Portifólio <span class="caret"></span></a>
                                <ul class="dropdown-menu">	        
                                    <li> <a href="admin.php?op=InserirNovoPortifolio">Adicionar Portifólio</a> </li>
                                    <li> <a href="admin.php?op=AlterarPortifolio1">Alterar Portifólio</a> </li>
                                    <li> <a href="admin.php?op=ExcluirPortifolio1">Excluir Portifólio</a> </li>


                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                    Albuns Portifólio <span class="caret"></span></a>
                                <ul class="dropdown-menu">	                                    
                                    <li> <a href="admin.php?op=InserirAlbuns1">Inserir Álbuns</a> </li>
                                    <li> <a href="admin.php?op=AlterarAlbuns1">Alterar Álbuns</a> </li>
                                    <li> <a href="admin.php?op=ExcluirAlbuns1">Excluir Álbuns</a> </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                    Gerenciar Blog <span class="caret"></span></a>
                                <ul class="dropdown-menu">	                                    
                                    <li> <a href="admin.php?op=InserirPostBlog1">Nova Postagem</a> </li>
                                    <li> <a href="admin.php?op=AlterarPostBlog1">Alterar Postagem</a> </li>
                                    <li> <a href="admin.php?op=ExcluirPostBlog1">Excluir Postagem</a> </li>

                                </ul>
                            </li>                              

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                    Imagens Blog <span class="caret"></span></a>
                                <ul class="dropdown-menu">	                                    
                                    <li> <a href="admin.php?op=LinkImagemBlog">Upload de Imagem</a> </li>
                                    <li> <a href="admin.php?op=VerLinks">Ver Links das Imagem</a> </li>

                                </ul>
                            </li>           


                            <li><a href="logout.php" >Sair</a></li>


                        </ul>

                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <?php
            if (isset($_SESSION['login'])) {
                if ($_GET) {
                    if (isset($_GET['op'])) {
                        $op = $_GET['op'];



                        if ($op == "InserirNovoPortifolio") {
                            include("./InserirPortifolio.php");
                        }
                        if ($op == "AlterarPortifolio1") {
                            include("./AlterarPortifolio1.php");
                        }

                        if ($op == "AlterarPortifolio2") {
                            include("./AlterarPortifolio2.php");
                        }

                        if ($op == "ExcluirPortifolio1") {
                            include("./ExcluirPortifolio1.php");
                        }
                        if ($op == "ExcluirPortifolio2") {
                            include("./ExcluirPortifolio2.php");
                        }
                        if ($op == "InserirAlbuns1") {
                            include("./InserirAlbuns1.php");
                        }
                        if ($op == "InserirAlbuns2") {
                            include("./InserirAlbuns2.php");
                        }
                        if ($op == "InserirPostBlog1") {
                            include("./InserirPostBlog1.php");
                        }
                        if ($op == "LinkImagemBlog") {
                            include("./LinkImagemBlog1.php");
                        }
                        if ($op == "VerLinks") {
                            include("./VerLinksImagensBlog.php");
                        }
                    }
                }
            } else {
                session_destroy();
                echo "<script>location.href='index.php';</script>";
            }
            ?>


        </div>  


    </body>
    <script src="../bootstrap/jquery-1.11.3.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>


</html>

