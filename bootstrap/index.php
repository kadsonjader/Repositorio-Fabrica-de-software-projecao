
<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />
        <link rel="icon" href="icone.ico" type="image/x-icon" />
    </head>

    <link rel="stylesheet" href="styleLogin.css">
    <body>


        <div class="page-header" align="center" >
            <h1> Painel Adminstrador NWD</h1> 
            <h2> <small>Página Administrativa</small></h2>
        </div>



        <div class="row">
            <div class="col-md-4">
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Acesso ao painel de controle
                    </div>



                    <div class="panel-body">
                        <form name="formAcessar" method="post" action="index.php"> 

                            <div class="row">

                                <div class="col-md-6">
                                    Usuário <input type="text" name="login" required class="form-control"/>
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
                                <div class="col-md-12">

                                </div>
                            </div>
                            
                            
                            
                            <div class="row">

                                <div class="col-md-4">
                                    <input type="submit" name="Entrar" value="Acessar" class="btn btn-success"/>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>
                <div class="col-md-4">
                </div>

            </div>




            <?php
            if ($_POST) {

                include("../classes/Conexao.class.php");
                include("../classes/DAO/UsuarioDAO.class.php");




                $usuario = new UsuarioDAO();

                $login = addslashes($_POST['login']);
                $senha = addslashes($_POST['senha']);


                $user = $usuario->login($senha, $login);

                if ($user == TRUE) {
                    session_start();
                    $_SESSION['login'] = $login;
                    $_SESSION['senha'] = $senha;
                    header("location: admin.php");
                    exit;
                } else {

                    header("location: index.php?erro=senha");
                }
            }
            ?>


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
                    header("location: admin.php");
                    exit;
                } else {

                    header("location: index.php?erro=senha");
                }
            }
            ?>


            <?php
            if ($_GET) {
                if (isset($_GET['erro'])) {
                    echo " 
    
                <div class='row'>
                    

                    <div class='col-md-8'>			
                    
                    </div>
                    
                    
                    <div class='col-md-4'>			
                        <div class='alert alert-danger'>
                            Usuário ou senha inválidos!
                        </div>   
                    </div>
                        

                    </div>";
                }
            }
            ?>



        </form>
    </div>

</div>


<script src="../bootstrap/jquery-1.11.3.min.js"></script>        
<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>



