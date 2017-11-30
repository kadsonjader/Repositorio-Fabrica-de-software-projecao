<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Acessar</title>
        <link rel="icon" href="icone.ico" type="image/x-icon" />
    </head>
    <body>

        <div class="row">
            <div class="col-md-8">
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Login
                    </div>



                    <div class="panel-body">
                        <form name="formAcessar" method="post" action="Acessar.php"> 

                            <div class="row">

                                <div class="col-md-6">
                                    E-mail: <input type="text" name="login" required class="form-control"/>
                                </div>


                                <div class="col-md-6">
                                    Senha: <input type="password" name="senha" required class="form-control"/>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <input type="submit" name="Entrar" value="Entrar" class="btn btn-success"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>




            <?php
            if ($_POST) {

                include("./classes/configuracao/Conexao.class.php");
                include("./classes/dao/UsuarioDAO.class.php");




                $usuario = new UsuarioDAO();
                
                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);


                $user = $usuario->login($senha, $login);

                if ($user == TRUE) {
                    session_start();
                    $_SESSION['login'] = $login;
                    $_SESSION['senha'] = $senha;                    
                    header("location: principal.php");
                    exit;
                } else {

                    header("location: index.php?erro=senha");
                }
            }
            ?>








            <script src="bootstrap/jquery-1.11.3.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
        </div>
    </body>
</html>
